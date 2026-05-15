<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    /**
     * Get all destinations data from database.
     */
    public static function getDestinationsData()
    {
        return Destination::where('is_active', true)->get();
    }

    /**
     * Find a destination by ID.
     */
    public static function findById(string $id)
    {
        return Destination::find($id);
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
        $query = Destination::where('is_active', true);

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('limit')) {
            $query->limit((int) $request->limit);
        }

        return response()->json($query->get());
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
