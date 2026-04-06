<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
        'base_image',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function availableRooms($checkIn, $checkOut)
    {
        return $this->rooms()
            ->where('status', 'available')
            ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<=', $checkOut)
                      ->where('check_out', '>=', $checkIn);
                });
            });
    }

    public function reviews()
    {
        return Review::whereHas('booking.room.roomType', fn($q) => $q->where('id', $this->id));
    }
} 

