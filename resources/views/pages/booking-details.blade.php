@extends('layouts.app')

@section('title', 'Booking Details - GODuls')

@section('content')
<main class="pt-28 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-600 transition-colors mb-6 text-sm font-medium">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to My Bookings
        </a>

        <!-- Ticket Card -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 flex flex-col md:flex-row">
            <!-- Main Ticket Info -->
            <div class="flex-1 p-8 md:p-12 relative overflow-hidden">
                <!-- Decorative Plane -->
                <div class="absolute -top-10 -right-10 opacity-[0.03] pointer-events-none">
                    <i data-lucide="plane" class="w-64 h-64"></i>
                </div>

                <div class="flex items-center justify-between mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                            <i data-lucide="plane" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">E-Ticket</h2>
                            <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Boarding Pass</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-gray-400 block uppercase font-bold">Order ID</span>
                        <span class="text-lg font-mono font-bold text-gray-900">#{{ $booking->booking_id }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-y-8 gap-x-12 mb-12">
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Passenger</span>
                        <p class="text-base font-bold text-gray-900">{{ $booking->guest_name }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Destination</span>
                        <p class="text-base font-bold text-gray-900">{{ $booking->destination->title }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Travel Date</span>
                        <p class="text-base font-bold text-gray-900">{{ $booking->travel_date->format('l, d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Guests</span>
                        <p class="text-base font-bold text-gray-900">{{ $booking->guests }} Person(s)</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Status</span>
                        <span class="inline-block px-3 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border 
                            {{ $booking->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }}">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>

                <div class="pt-8 border-t border-dashed border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-1.5">
                            <div class="w-1.5 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-1.5 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-4 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-1.5 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-2 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-1.5 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-3 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-1.5 h-8 bg-gray-900 rounded-full"></div>
                            <div class="w-1.5 h-8 bg-gray-900 rounded-full"></div>
                        </div>
                        <p class="text-[10px] text-gray-400 font-mono">SCAN_FOR_CHECK_IN</p>
                    </div>
                </div>
            </div>

            <!-- Pricing / Action Sidebar -->
            <div class="w-full md:w-80 bg-gray-900 p-8 md:p-12 text-white flex flex-col justify-between border-l border-white/5 relative">
                <!-- Perforated Line Decoration -->
                <div class="absolute top-0 left-0 bottom-0 flex flex-col justify-around -translate-x-1/2 pointer-events-none hidden md:flex">
                    @for($i=0; $i<15; $i++)
                        <div class="w-2 h-2 rounded-full bg-gray-50"></div>
                    @endfor
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6">Payment Summary</h3>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm">
                            <span class="text-white/50">Base Price</span>
                            <span>{{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-white/50">Tax (10%)</span>
                            <span>{{ number_format($booking->tax_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="h-px bg-white/10 my-4"></div>
                        <div class="flex justify-between items-end">
                            <span class="text-white/50 text-sm">Total Paid</span>
                            <span class="text-2xl font-bold text-blue-400">{{ $booking->formatted_grand_total }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <button onclick="window.print()" class="w-full bg-white text-gray-900 font-bold py-3 rounded-xl hover:bg-gray-100 transition-colors flex items-center justify-center gap-2 text-sm">
                        <i data-lucide="printer" class="w-4 h-4"></i> Print Ticket
                    </button>
                    @if($booking->status === 'confirmed' && $booking->travel_date->isFuture())
                        <form action="{{ route('bookings.refund', $booking->booking_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to request a refund?')">
                            @csrf
                            <button type="submit" class="w-full bg-red-500/10 text-red-400 border border-red-500/20 font-bold py-3 rounded-xl hover:bg-red-500/20 transition-colors flex items-center justify-center gap-2 text-sm cursor-pointer">
                                <i data-lucide="refresh-ccw" class="w-4 h-4"></i> Request Refund
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Extra Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                <h4 class="font-bold text-blue-900 flex items-center gap-2 mb-2">
                    <i data-lucide="info" class="w-4 h-4"></i> Check-in Instructions
                </h4>
                <p class="text-sm text-blue-800/70 leading-relaxed">Please arrive at the meeting point at least 30 minutes before the scheduled time. Present this e-ticket along with a valid ID.</p>
            </div>
            <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100">
                <h4 class="font-bold text-amber-900 flex items-center gap-2 mb-2">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i> Refund Policy
                </h4>
                <p class="text-sm text-amber-800/70 leading-relaxed">Refunds are available up to 24 hours before travel date. A 10% processing fee may apply for certain destinations.</p>
            </div>
        </div>
    </div>
</main>
@endsection
