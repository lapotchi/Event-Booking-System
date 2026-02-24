<?php

namespace Database\Seeders;

use App\Enums\BookingStatusEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Payment;
use App\Enums\PaymentStatus;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all customers
        $customers = User::where('role', 'customer')->get();

        // Get all tickets
        $tickets = Ticket::all();

        // Create 20 bookings
        for ($i = 0; $i < 20; $i++) {
            $ticket = $tickets->random();
            $customer = $customers->random();

            $quantity = fake()->numberBetween(1, min($ticket->quantity, 5)); // max 5 per booking
            $bookingStatus = fake()->randomElement(array_column(BookingStatusEnum::cases(), 'value'));

            // Create booking
            $booking = Booking::factory()->state([
                'user_id' => $customer->id,
                'ticket_id' => $ticket->id,
            ])->create();

            // Optionally, create a mock payment
            $payment = Payment::factory()->state([
                'booking_id' => $booking->id,
                'amount' => $ticket->price * $quantity,
            ])->create();

            // Decrease ticket quantity to reflect booked tickets
            if ($bookingStatus == BookingStatusEnum::CONFIRMED->value && $payment->status == PaymentStatusEnum::SUCCESS->value) {
                $ticket->decrement('quantity', $quantity);
            }
        }
    }
}
