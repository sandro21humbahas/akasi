<?php

namespace App\Http\Requests;

use App\Models\Room;
use App\Services\BookingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        parent::__construct();
        $this->bookingService = $bookingService;
    }

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $roomId = $this->input('room_id');
        $checkIn = $this->input('check_in');
        $checkOut = $this->input('check_out');

        return [
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'total_price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $roomId = $this->input('room_id');
            $checkIn = $this->input('check_in');
            $checkOut = $this->input('check_out');

            $room = Room::find($roomId);
            $available = $this->bookingService->checkAvailability(
                $room->room_type_id, 
                \Carbon\Carbon::parse($checkIn), 
                \Carbon\Carbon::parse($checkOut)
            )->contains($roomId);

            if (!$available) {
                $validator->errors()->add('room_id', 'Room not available for selected dates.');
            }
        });
    }
}

