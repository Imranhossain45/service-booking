<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_book_a_service()
    {
        $this->seed(); 

        $user = User::factory()->create();
        $service = Service::first();

        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/bookings', [
            'service_id' => $service->id,
            'booking_date' => now()->addDays(1)->format('Y-m-d'),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'booking_date',
            'status',
            'service',
        ]);
    }

    public function test_booking_fails_on_past_date()
    {
        $this->seed();
        $user = User::factory()->create();
        $service = Service::first();

        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/bookings', [
            'service_id' => $service->id,
            'booking_date' => now()->subDay()->format('Y-m-d'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('booking_date');
    }
}