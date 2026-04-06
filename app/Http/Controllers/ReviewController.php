<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Booking $booking)
    {
        $this->authorize('review', $booking);

        Review::updateOrCreate(
            ['booking_id' => $booking->id],
            $request->validated()
        );

        return redirect()->route('dashboard')->with('success', 'Review berhasil dikirim! ⭐');
    }

    public function create(Booking $booking)
    {
        $this->authorize('review', $booking);
        return view('reviews.create', compact('booking'));
    }
}

