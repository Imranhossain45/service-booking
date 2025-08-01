<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id'      => User::factory(), 
            'service_id'   => Service::factory(), 
            'booking_date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
            'status'       => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}