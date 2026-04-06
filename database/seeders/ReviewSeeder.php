<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'booking_id' => Booking::inRandomOrder()->first()?->id ?? 1,
                'rating' => 5,
                'comment' => 'Kamar sangat nyaman dan bersih. Staff ramah dan sarapan mantap!',
            ],
            [
                'booking_id' => Booking::inRandomOrder()->first()?->id ?? 2,
                'rating' => 4,
                'comment' => 'Lokasi strategis, fasilitas lengkap. Akan menginap lagi!',
            ],
            [
                'booking_id' => Booking::inRandomOrder()->first()?->id ?? 3,
                'rating' => 5,
                'comment' => 'Luxury stay with great service. Recommended!',
            ],
        ];

        foreach ($reviews as $data) {
            Review::create($data);
        }
    }
}

