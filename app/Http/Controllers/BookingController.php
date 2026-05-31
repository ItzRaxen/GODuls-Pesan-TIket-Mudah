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

        // Midtrans configuration
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $totalPrice = $destination['price'] * $booking['guests'];
        $taxAmount  = $totalPrice * 0.1;
        $grandTotal = $totalPrice + $taxAmount;

        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . time() . '-' . uniqid(),
                'gross_amount' => $grandTotal,
            ],
            'customer_details' => [
                'first_name' => auth()->check() ? auth()->user()->name : 'Guest',
                'email' => auth()->check() ? auth()->user()->email : 'guest@example.com',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('pages.payment', compact('destination', 'booking', 'snapToken'));
    }

    /**
     * Process refund request.
     */
    public function refund(string $bookingId)
    {
        $booking = \App\Models\Booking::where('booking_id', $bookingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($booking->status !== \App\Models\Booking::STATUS_CONFIRMED) {
            return back()->with('error', 'Only confirmed bookings can be refunded.');
        }

        // Check if travel date is in the future
        if ($booking->travel_date->isPast()) {
            return back()->with('error', 'Cannot refund past bookings.');
        }

        $booking->update([
            'status' => \App\Models\Booking::STATUS_REFUND_PENDING
        ]);

        // Trigger Notification
        auth()->user()->notify(new \App\Notifications\BookingStatusChanged($booking));

        return back()->with('success', 'Refund request submitted successfully. We will process it within 24 hours.');
    }
}
