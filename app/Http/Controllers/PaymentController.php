<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Process payment and show success page.
     */
    public function process(Request $request, string $destinationId)
    {
        $request->validate([
            'cardholder_name' => ['required', 'string', 'min:2', 'max:100'],
            'card_number'     => ['required', 'string'],
            'expiry'          => ['required', 'string', 'regex:/^\d{2}\/\d{2}$/'],
            'cvc'             => ['required', 'string', 'digits:3'],
        ]);

        $destination = DestinationController::findById($destinationId);

        if (!$destination) {
            abort(404, 'Destination not found.');
        }

        $booking = session('booking');

        if (!$booking || $booking['destination_id'] !== $destinationId) {
            return redirect()->route('home')
                ->with('error', 'Booking session expired. Please start again.');
        }

        // Generate a booking confirmation ID
        $bookingId = strtoupper(substr(md5(uniqid()), 0, 8));

        // Store success data in session
        session([
            'payment_success' => [
                'booking_id'     => $bookingId,
                'destination_id' => $destinationId,
                'booking'        => $booking,
            ],
        ]);

        // Clear the booking session
        session()->forget('booking');

        return redirect()->route('payment.success', $destinationId);
    }

    /**
     * Show the payment success page.
     */
    public function success(string $destinationId)
    {
        $destination = DestinationController::findById($destinationId);

        if (!$destination) {
            abort(404, 'Destination not found.');
        }

        $successData = session('payment_success');

        if (!$successData || $successData['destination_id'] !== $destinationId) {
            return redirect()->route('home');
        }

        $booking   = $successData['booking'];
        $bookingId = $successData['booking_id'];

        // Clear success session after displaying
        session()->forget('payment_success');

        return view('pages.payment-success', compact('destination', 'booking', 'bookingId'));
    }
}
