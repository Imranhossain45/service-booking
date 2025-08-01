<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::inRandomOrder()->take(5)->get();
        $services = Service::all();

        foreach ($users as $user) {
            Booking::factory()->count(2)->create([
                'user_id' => $user->id,
                'service_id' => $services->random()->id,
            ]);
        }
    }
}