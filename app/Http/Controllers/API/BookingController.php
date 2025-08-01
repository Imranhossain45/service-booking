<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('service')
                    ->where('user_id', $request->user()->id)
                    ->latest()
                    ->get();

        return BookingResource::collection($bookings);
    }

    public function store(BookingRequest $request)
    {
        $service = Service::findOrFail($request->service_id);

        if (Carbon::parse($request->booking_date)->isPast()) {
            return response()->json(['message' => 'Booking date cannot be in the past'], 422);
        }

        $booking = Booking::create([
            'user_id'      => $request->user()->id,
            'service_id'   => $request->service_id,
            'booking_date' => $request->booking_date,
            'status'       => 'pending',
        ]);

        return new BookingResource($booking);
    }
}