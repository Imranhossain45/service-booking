<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
  AuthController,
  ServiceController,
  BookingController
};

use App\Http\Controllers\API\Admin\BookingController as AdminBookingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  // Customer
  Route::get('/services', [ServiceController::class, 'index']);
  Route::post('/bookings', [BookingController::class, 'store']);
  Route::get('/bookings', [BookingController::class, 'index']);

  // Admin only
  Route::middleware('admin')->group(function () {
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
    Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
  });
});