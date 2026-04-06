<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingService
{
    public function checkAvailability(int $roomTypeId, Carbon $checkIn, Carbon $checkOut): \Illuminate\Database\Eloquent\Collection
    {
        return RoomType::findOrFail($roomTypeId)
            ->availableRooms($checkIn, $checkOut)
            ->get();
    }

    public function calculateTotalPrice(Carbon $checkIn, Carbon $checkOut, float $pricePerNight): float
    {
        $nights = $checkOut->diffInDays($checkIn);
        return $nights * $pricePerNight;
    }

    public function createPendingBooking(array $data): Booking
    {
        return Booking::create($data);
    }

    public function generateSnapToken(Booking $booking): string
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $transactionDetails = [
            'order_id' => 'AKASI-' . $booking->id . '-' . time(),
            'gross_amount' => $booking->total_price,
        ];

        $itemDetails = [[
            'id' => 'ROOM-' . $booking->room->room_type_id,
            'price' => $booking->room->roomType->price_per_night,
            'quantity' => $booking->nights,
            'name' => $booking->room->roomType->name . ' Room ' . $booking->room->room_number,
        ]];

        $customerDetails = [
            'first_name' => $booking->user->name,
            'email' => $booking->user->email,
        ];

        $payload = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        return \Midtrans\Snap::getSnapToken($payload);
    }

    public function handleWebhook(array $payload)
    {
        $transactionId = $payload['order_id'] ?? '';
        if (preg_match('/AKASI-(\d+)/', $transactionId, $matches)) {
            $bookingId = $matches[1];
            $booking = Booking::find($bookingId);

            if ($booking) {
                $status = $payload['transaction_status'] === 'settlement' ? 'confirmed' : 'cancelled';
                $booking->update(['status' => $status]);
                $booking->room->update(['status' => $status === 'confirmed' ? 'booked' : 'available']);

                Payment::updateOrCreate(
                    ['booking_id' => $booking->id],
                    [
                        'transaction_id' => $payload['transaction_id'] ?? '',
                        'payment_type' => $payload['payment_type'] ?? 'unknown',
                        'gross_amount' => $payload['gross_amount'] ?? 0,
                        'transaction_status' => $payload['transaction_status'] ?? '',
                    ]
                );
            }
        }
    }
}

