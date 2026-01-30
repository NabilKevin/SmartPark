<?php

namespace Database\Seeders;

use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'Admin',
            'email' => 'admin1@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        User::create([
            'username' => 'user',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $parkinglot1 = ParkingLot::create([
            'name' => 'Kalibata mall - basement',
            'capacity' => 20,
            'available_spots' => 20,
            'prefix' => 'A'
        ]);

        $parkinglot2 = ParkingLot::create([
            'name' => 'Kalibata mall - lt 1',
            'capacity' => 17,
            'available_spots' => 17,
            'prefix' => 'A'
        ]);

        for($i = 0; $i < 20; $i++) {
            ParkingSpot::create([
                'parking_lot_id' => $parkinglot1->id,
                'spot_number' => $parkinglot1->prefix . str_pad($i+1, 3, '0', STR_PAD_LEFT),
            ]);
        }
        for($i = 0; $i < 17; $i++) {
            ParkingSpot::create([
                'parking_lot_id' => $parkinglot2->id,
                'spot_number' => $parkinglot2->prefix . str_pad($i+1, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
