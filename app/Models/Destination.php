<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'destinations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category',
        'title',
        'price',
        'rating',
        'reviews',
        'image',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'price'     => 'integer',
        'rating'    => 'float',
        'reviews'   => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Filter by category.
     */
    public function scopeByCategory($query, string $category)
    {
        if ($category && $category !== 'All') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope: Only active destinations.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Filter by max price.
     */
    public function scopeMaxPrice($query, int $maxPrice)
    {
        return $query->where('price', '<=', $maxPrice);
    }

    /**
     * Get formatted price in IDR.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Relationship: Has many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
