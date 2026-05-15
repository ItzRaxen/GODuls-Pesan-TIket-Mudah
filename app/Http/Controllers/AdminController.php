<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\BookingStatusChanged;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with overview stats.
     */
    public function index()
    {
        $stats = [
            'total_revenue' => Booking::where('status', 'confirmed')->sum('grand_total'),
            'total_bookings' => Booking::count(),
            'pending_refunds' => Booking::where('status', 'refund_pending')->count(),
            'total_users' => User::count(),
        ];

        $recent_bookings = Booking::with(['user', 'destination'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }

    /**
     * List all bookings for management.
     */
    public function bookings()
    {
        $bookings = Booking::with(['user', 'destination'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Update booking status (confirm, cancel, refund).
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->status = $request->status;
        $booking->save();

        // Notify user about status change
        if ($booking->user) {
            $booking->user->notify(new BookingStatusChanged($booking));
        }

        return back()->with('success', "Booking #{$booking->booking_id} status updated to " . strtoupper($request->status));
    }

    /**
     * List all destinations.
     */
    public function destinations()
    {
        $destinations = Destination::orderBy('created_at', 'desc')->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show create destination form.
     */
    public function createDestination()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store new destination.
     */
    public function storeDestination(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'description' => 'nullable|string',
        ]);

        Destination::create([
            'title' => $request->title,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $request->image,
            'description' => $request->description,
            'rating' => 5.0,
            'reviews' => 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.destinations')->with('success', 'Destination created successfully.');
    }

    /**
     * Delete destination.
     */
    public function deleteDestination($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return back()->with('success', 'Destination deleted successfully.');
    }
}
