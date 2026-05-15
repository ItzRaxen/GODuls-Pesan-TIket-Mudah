<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the user's booking history.
     */
    public function index()
    {
        $user = Auth::user();
        
        $bookings = Booking::where('user_id', $user->id)
            ->with('destination')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.profile', compact('user', 'bookings'));
    }

    /**
     * Show dedicated notifications page.
     */
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('pages.notifications', compact('notifications'));
    }

    /**
     * Show notification details.
     */
    public function showNotification(string $id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        
        if (!$notification->read_at) {
            $notification->markAsRead();
        }

        return view('pages.notification-details', compact('notification'));
    }

    /**
     * Delete a notification.
     */
    public function deleteNotification(string $id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Show details of a specific booking.
     */
    public function showBooking(string $bookingId)
    {
        $booking = Booking::where('booking_id', $bookingId)
            ->where('user_id', Auth::id())
            ->with('destination')
            ->firstOrFail();

        return view('pages.booking-details', compact('booking'));
    }

    /**
     * Mark a notification as read.
     */
    public function markNotificationRead(string $id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'All notifications marked as read.');
    }
}
