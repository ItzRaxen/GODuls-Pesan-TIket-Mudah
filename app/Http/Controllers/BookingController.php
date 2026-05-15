<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Process the booking form submission and redirect to payment.
     */
    public function store(Request $request, string $destinationId)
    {
        $request->validate([
            'date'   => ['required', 'date', 'after:today'],
            'guests' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $destination = DestinationController::findById($destinationId);

        if (!$destination) {
            abort(404, 'Destination not found.');
        }

        // Store booking data in session
        session([
            'booking' => [
                'destination_id' => $destinationId,
                'date'           => $request->date,
                'guests'         => (int) $request->guests,
            ],
        ]);

        return redirect()->route('payment.show', $destinationId);
    }

    /**
     * Show the payment page with booking details from session.
     */
    public function showPayment(string $destinationId)
    {
        $destination = DestinationController::findById($destinationId);

        if (!$destination) {
            abort(404, 'Destination not found.');
        }

        $booking = session('booking');

        if (!$booking || $booking['destination_id'] !== $destinationId) {
            return redirect()->route('booking.show', $destinationId)
                ->with('error', 'Please complete your booking details first.');
        }

        return view('pages.payment', compact('destination', 'booking'));
    }
}
