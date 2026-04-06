<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\RoomType;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $roomTypes = RoomType::with('rooms')->get();
        return view('rooms.index', compact('roomTypes'));
    }

    public function show(RoomType $roomType, Request $request)
    {
        $checkIn = $request->get('check_in') ? Carbon::parse($request->get('check_in')) : now()->addDay();
        $checkOut = $request->get('check_out') ? Carbon::parse($request->get('check_out')) : $checkIn->copy()->addDays(1);

        $availableRooms = $this->bookingService->checkAvailability($roomType->id, $checkIn, $checkOut);

        $totalPrice = $this->bookingService->calculateTotalPrice($checkIn, $checkOut, $roomType->price_per_night);

        return view('rooms.show', compact('roomType', 'availableRooms', 'checkIn', 'checkOut', 'totalPrice'));
    }

    public function store(StoreBookingRequest $request)
    {
        $validated = $request->validated();

        $bookingData = [
            'user_id' => Auth::id(),
            'room_id' => $validated['room_id'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'total_price' => $validated['total_price'],
            'status' => 'pending',
        ];

        $booking = $this->bookingService->createPendingBooking($bookingData);

        $snapToken = $this->bookingService->generateSnapToken($booking);

        return view('bookings.pay', compact('booking', 'snapToken'));
    }
}

