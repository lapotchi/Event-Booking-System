<?php

use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\BookingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // List events (any authenticated user)
    Route::get('/events', [EventController::class, 'index']);

    // Event details with tickets (any authenticated user)
    Route::get('/events/{event}', [EventController::class, 'show']);

    // Organizer-only actions
    Route::middleware('checkRole:organizer,admin')->group(function () {
        Route::post('/events', [EventController::class, 'store']);
        Route::put('/events/{event}', [EventController::class, 'update']);
        Route::delete('/events/{event}', [EventController::class, 'destroy']);

        Route::post('/events/{event}/tickets', [TicketController::class,'store']);
        Route::put('/tickets/{ticket}', [TicketController::class,'update']);
        Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
    });

     Route::middleware('checkRole:customer,admin')->group(function () {
        Route::post('/tickets/{ticket}/bookings', [BookingController::class,'store']);
    });

});
