<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Ticket;

class BookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        if ($validated['quantity'] > $ticket->quantity) {
            return response()->json([
                'message' => 'Not enough tickets available.'
            ], 400);
        }

        $totalPrice = $ticket->price * $validated['quantity'];

        // Create booking
        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'ticket_id' => $ticket->id,
            'quantity' => $validated['quantity'],
            'status' => 'pending', 
        ]);

        // Reduce ticket stock
        $ticket->decrement('quantity', $validated['quantity']);

        return response()->json([
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }
}
