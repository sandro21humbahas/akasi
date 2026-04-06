<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'room_number',
        'status',
    ];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailable($query, $checkIn, $checkOut)
    {
        return $query->where('status', 'available')
            ->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($subQ) use ($checkIn, $checkOut) {
                    $subQ->where('check_in', '<=', $checkOut)
                         ->where('check_out', '>=', $checkIn)
                         ->where('status', '!=', 'cancelled');
                });
            });
    }
}

