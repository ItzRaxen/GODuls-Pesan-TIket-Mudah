<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingSuccessful extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->booking_id,
            'message'    => "Pemesanan tiket ke {$this->booking->destination->title} berhasil! ID: #{$this->booking->booking_id}",
            'url'        => route('profile'),
        ];
    }
}
