<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function review(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id && 
               $booking->status === 'confirmed' && 
               is_null($booking->review);
    }

    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id;
    }
}

