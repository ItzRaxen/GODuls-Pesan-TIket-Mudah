<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'booking_id',
        'destination_id',
        'guest_name',
        'guest_email',
        'travel_date',
        'guests',
        'total_price',
        'tax_amount',
        'grand_total',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'travel_date' => 'date',
        'guests'      => 'integer',
        'total_price' => 'integer',
        'tax_amount'  => 'integer',
        'grand_total' => 'integer',
    ];

    /**
     * Status constants.
     */
    const STATUS_PENDING   = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Relationship: Belongs to a destination.
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get formatted grand total.
     */
    public function getFormattedGrandTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    /**
     * Generate a unique booking ID.
     */
    public static function generateBookingId(): string
    {
        return 'GDL-' . strtoupper(substr(md5(uniqid()), 0, 8));
    }
}
