<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;

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

        $bookingData = session('booking');

        if (!$bookingData || $bookingData['destination_id'] !== $destinationId) {
            return redirect()->route('home')
                ->with('error', 'Booking session expired. Please start again.');
        }

        // Calculate prices
        $totalPrice = $destination['price'] * $bookingData['guests'];
        $taxAmount  = $totalPrice * 0.1;
        $grandTotal = $totalPrice + $taxAmount;

        // Create booking in database
        $booking = Booking::create([
            'booking_id'     => Booking::generateBookingId(),
            'user_id'        => Auth::id(),
            'destination_id' => $destinationId,
            'guest_name'     => Auth::user() ? Auth::user()->name : $request->cardholder_name,
            'guest_email'    => Auth::user() ? Auth::user()->email : null,
            'travel_date'    => $bookingData['date'],
            'guests'         => $bookingData['guests'],
            'total_price'    => $totalPrice,
            'tax_amount'     => $taxAmount,
            'grand_total'    => $grandTotal,
            'status'         => Booking::STATUS_CONFIRMED,
        ]);

        // Trigger Notification
        if (Auth::user()) {
            Auth::user()->notify(new \App\Notifications\BookingSuccessful($booking));
        }

        // Store success data in session
        session([
            'payment_success' => [
                'booking_id'     => $booking->booking_id,
                'destination_id' => $destinationId,
                'booking'        => $booking->toArray(),
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
