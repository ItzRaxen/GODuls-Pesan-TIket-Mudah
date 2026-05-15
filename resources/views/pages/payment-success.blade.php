@extends('layouts.app')

@section('title', 'Payment Successful - GODuls')

@section('content')
<main class="min-h-screen pt-32 pb-16 px-6 bg-gray-50 flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-xl text-center max-w-md w-full animate-fade-in-up">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="check-circle" class="w-10 h-10"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Payment Successful!</h2>
        <p class="text-gray-500 mb-8">
            Your booking for <strong>{{ $destination['title'] }}</strong> has been confirmed. Thank you for your purchase.
        </p>
        <div class="bg-gray-50 rounded-2xl p-4 mb-8 text-sm text-left space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-500">Booking ID</span>
                <span class="font-semibold text-gray-900">#{{ $bookingId }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Destination</span>
                <span class="font-semibold text-gray-900">{{ $destination['title'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Date</span>
                <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking['travel_date'])->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Guests</span>
                <span class="font-semibold text-gray-900">{{ $booking['guests'] }}</span>
            </div>
            <div class="flex justify-between border-t pt-2 mt-2">
                <span class="text-gray-500">Total Paid</span>
                <span class="font-bold text-blue-600">Rp {{ number_format($booking['grand_total'], 0, ',', '.') }}</span>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn-primary w-full py-4 rounded-xl flex items-center justify-center gap-2">
            Back to Home <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
    </div>
</main>
@endsection
