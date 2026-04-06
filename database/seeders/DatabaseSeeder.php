<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user first
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@akasihotel.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            RoleSeeder::class,
            RoomTypeSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}


