<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * All destinations data (replaces the React mock API).
     * In production, this would be fetched from the database via Eloquent.
     */
    public static function getDestinationsData(): array
    {
        return [
            [
                'id'       => '1',
                'category' => 'Beach & Island',
                'title'    => 'Bali Paradise Escape',
                'price'    => 2500000,
                'rating'   => 4.8,
                'reviews'  => 1240,
                'image'    => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '2',
                'category' => 'City Tour',
                'title'    => 'Tokyo Explorer Pass',
                'price'    => 4200000,
                'rating'   => 4.9,
                'reviews'  => 892,
                'image'    => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '3',
                'category' => 'Nature & Adventure',
                'title'    => 'Swiss Alps Journey',
                'price'    => 8500000,
                'rating'   => 4.7,
                'reviews'  => 567,
                'image'    => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '4',
                'category' => 'City Tour',
                'title'    => 'Paris Romance Tour',
                'price'    => 7500000,
                'rating'   => 4.9,
                'reviews'  => 1823,
                'image'    => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '5',
                'category' => 'Beach & Island',
                'title'    => 'Maldives Getaway',
                'price'    => 12000000,
                'rating'   => 5.0,
                'reviews'  => 432,
                'image'    => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '6',
                'category' => 'Nature & Adventure',
                'title'    => 'Kenya Safari Experience',
                'price'    => 9500000,
                'rating'   => 4.8,
                'reviews'  => 298,
                'image'    => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '7',
                'category' => 'Beach & Island',
                'title'    => 'Santorini Sunset',
                'price'    => 8200000,
                'rating'   => 4.7,
                'reviews'  => 712,
                'image'    => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '8',
                'category' => 'City Tour',
                'title'    => 'New York City Lights',
                'price'    => 6800000,
                'rating'   => 4.6,
                'reviews'  => 1456,
                'image'    => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'id'       => '9',
                'category' => 'Nature & Adventure',
                'title'    => 'Patagonia Hiking',
                'price'    => 10500000,
                'rating'   => 4.9,
                'reviews'  => 189,
                'image'    => 'https://images.unsplash.com/photo-1534481418361-125010091814?auto=format&fit=crop&q=80&w=800',
            ],
        ];
    }

    /**
     * Find a destination by ID.
     */
    public static function findById(string $id): ?array
    {
        $data = self::getDestinationsData();
        foreach ($data as $dest) {
            if ($dest['id'] === $id) {
                return $dest;
            }
        }
        return null;
    }

    /**
     * Display all destinations page.
     */
    public function index()
    {
        return view('pages.destinations');
    }

    /**
     * API endpoint: Return all destinations as JSON.
     */
    public function apiIndex(Request $request)
    {
        $destinations = self::getDestinationsData();
        $limit = $request->query('limit');

        if ($limit) {
            $destinations = array_slice($destinations, 0, (int) $limit);
        }

        return response()->json($destinations);
    }

    /**
     * Show the booking page for a specific destination.
     */
    public function showBooking(string $id)
    {
        $destination = self::findById($id);

        if (!$destination) {
            abort(404, 'Destination not found.');
        }

        return view('pages.booking', compact('destination'));
    }
}
