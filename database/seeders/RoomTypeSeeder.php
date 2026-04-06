<?php

namespace Database\Seeders;

use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = [
            [
                'name' => 'Deluxe Room',
                'description' => 'Comfortable room with city view, king bed, and modern amenities.',
                'price_per_night' => 850000,
                'capacity' => 2,
                'base_image' => 'https://images.unsplash.com/photo-1564507592333-c9161e5d0acd?w=500',
            ],
            [
                'name' => 'Executive Suite',
                'description' => 'Spacious suite with living area, balcony, and premium facilities.',
                'price_per_night' => 1500000,
                'capacity' => 3,
                'base_image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=500',
            ],
            [
                'name' => 'Family Room',
                'description' => 'Perfect for families, two queen beds, kitchenette included.',
                'price_per_night' => 1200000,
                'capacity' => 4,
                'base_image' => 'https://images.unsplash.com/photo-1578683015141-399d779609f6?w=500',
            ],
        ];

        foreach ($roomTypes as $data) {
            $roomType = RoomType::create($data);

            // Create 3 rooms per type
            for ($i = 101; $i <= 103; $i++) {
                Room::firstOrCreate(
                    ['room_type_id' => $roomType->id, 'room_number' => $roomType->id . '-' . str_pad($i, 3, '0', STR_PAD_LEFT)],
                    ['status' => 'available']
                );
            }
        }
    }
}



