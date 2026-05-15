@extends('layouts.app')

@section('title', 'My Profile - GODuls')

@section('content')
<main class="pt-28 pb-20 bg-gray-50/50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-3 block">User Dashboard</span>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Welcome, {{ explode(' ', $user->name)[0] }}!</h1>
                <p class="text-gray-500 mt-2">Manage your luxury travel experiences and booking history.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('destinations.index') }}" class="btn-primary flex items-center gap-2 px-6">
                    <i data-lucide="plus" class="w-4 h-4"></i> New Booking
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100">
                    <div class="text-center mb-8">
                        <div class="relative inline-block">
                            <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white text-3xl font-black shadow-xl shadow-blue-500/20 mx-auto">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 border-4 border-white rounded-full flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-white"></i>
                            </div>
                        </div>
                        <h2 class="font-bold text-gray-900 mt-4 text-lg">{{ $user->name }}</h2>
                        <p class="text-xs text-gray-400 font-medium">{{ $user->email }}</p>
                    </div>
                    
                    <nav class="space-y-1">
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 p-3.5 rounded-2xl bg-blue-50 text-blue-600 font-bold text-sm transition-all">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i> My Bookings
                        </a>
                        <a href="{{ route('notifications.index') }}" class="flex items-center justify-between p-3.5 rounded-2xl text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-semibold text-sm transition-all group">
                            <span class="flex items-center gap-3">
                                <i data-lucide="bell" class="w-4 h-4"></i> Notifications
                            </span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 p-3.5 rounded-2xl text-gray-400 hover:bg-red-50 hover:text-red-500 font-semibold text-sm transition-all group cursor-pointer text-left">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                            </button>
                        </form>
                    </nav>

                    <div class="pt-8 mt-8 border-t border-gray-50 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-semibold">Total Trips</span>
                            <span class="text-sm font-black text-gray-900">{{ $bookings->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-semibold">Status</span>
                            <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full uppercase tracking-tighter">Verified</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-9 space-y-8">
                <!-- Stats Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                            <i data-lucide="ticket" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Active Tickets</p>
                            <h3 class="text-2xl font-black text-gray-900">{{ $bookings->where('status', 'confirmed')->count() }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                            <i data-lucide="clock" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Refund Pending</p>
                            <h3 class="text-2xl font-black text-gray-900">{{ $bookings->where('status', 'refund_pending')->count() }}</h3>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600">
                            <i data-lucide="history" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Completed</p>
                            <h3 class="text-2xl font-black text-gray-900">{{ $bookings->where('travel_date', '<', now())->count() }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Booking History Table -->
                <div class="bg-white rounded-[2rem] shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900">Recent Transactions</h3>
                        <i data-lucide="filter" class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600 transition-colors"></i>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Destination</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Date</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Price</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($bookings as $booking)
                                    <tr class="hover:bg-gray-50/50 transition-colors group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $booking->destination->image }}" class="w-12 h-12 rounded-xl object-cover shadow-sm group-hover:scale-105 transition-transform">
                                                <div>
                                                    <p class="font-bold text-gray-900 text-sm">{{ $booking->destination->title }}</p>
                                                    <p class="text-[10px] text-gray-400 font-mono">ID: #{{ $booking->booking_id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-sm font-semibold text-gray-600">
                                            {{ $booking->travel_date->format('d M, Y') }}
                                        </td>
                                        <td class="px-8 py-5 text-sm font-black text-blue-600">
                                            {{ $booking->formatted_grand_total }}
                                        </td>
                                        <td class="px-8 py-5">
                                            @php
                                                $statusMeta = [
                                                    'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-600', 'label' => 'Pending'],
                                                    'confirmed' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'label' => 'Confirmed'],
                                                    'cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'Cancelled'],
                                                    'refund_pending' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'label' => 'Refunding'],
                                                    'refunded' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-400', 'label' => 'Refunded'],
                                                ];
                                                $meta = $statusMeta[$booking->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-400', 'label' => $booking->status];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tight {{ $meta['bg'] }} {{ $meta['text'] }}">
                                                {{ $meta['label'] }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-right space-x-2">
                                            <a href="{{ route('bookings.show', $booking->booking_id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="View Ticket">
                                                <i data-lucide="ticket" class="w-4 h-4"></i>
                                            </a>
                                            @if($booking->status === 'confirmed' && $booking->travel_date->isFuture())
                                                <form action="{{ route('bookings.refund', $booking->booking_id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Request Refund?', 'Are you sure you want to request a refund for this trip?', 'warning')" class="inline">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 hover:bg-red-500 hover:text-white transition-all shadow-sm cursor-pointer" title="Refund Ticket">
                                                        <i data-lucide="refresh-ccw" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200">
                                                <i data-lucide="ticket-x" class="w-10 h-10 text-gray-200"></i>
                                            </div>
                                            <p class="text-gray-400 font-semibold">No bookings found in your history.</p>
                                            <a href="{{ route('destinations.index') }}" class="text-blue-600 font-bold text-sm hover:underline mt-2 inline-block">Start your journey today</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
