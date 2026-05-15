<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Handle newsletter subscription.
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        // In production: save to database / send to email service
        // For now: just flash a success message

        return redirect()->back()->with('newsletter_success', 'Thank you for subscribing!');
    }
}
