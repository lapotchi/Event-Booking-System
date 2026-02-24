<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Event;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request, Event $event)
    {
        $validated = $request->validated();

        $validated['event_id'] = $event->id;

        $ticket = Ticket::create($validated);

        return response()->json([
            'message' => 'Ticket created successfully.',
            'data' => $ticket
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return response()->json([
            'message' => 'Event updated successfully.',
            'data' => $ticket
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->noContent();
    }
}
