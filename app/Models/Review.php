<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'rating', 'comment'];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStarsAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }

    // Average rating scope for RoomType
    public function scopeAverageRating($query, $roomTypeId = null)
    {
        $query->selectRaw('avg(rating) as avg_rating, count(*) as count')
            ->when($roomTypeId, function ($q) use ($roomTypeId) {
                $q->whereHas('booking.room.roomType', function ($sub) use ($roomTypeId) {
                    $sub->where('room_type_id', $roomTypeId);
                });
            });
    }
}

