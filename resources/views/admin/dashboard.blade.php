@extends('layouts.app')

@section('title', 'Admin Dashboard - GODuls')

@section('content')
<main class="pt-28 pb-20 bg-slate-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Admin Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-red-400 font-bold text-xs uppercase tracking-[0.2em]">Live Admin Terminal</span>
                </div>
                <h1 class="text-4xl font-black tracking-tight">System Overview</h1>
                <p class="text-slate-400 mt-2 text-lg">Central control for GODuls travel operations.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-sm font-mono text-slate-300">
                    Last sync: {{ now()->format('H:i:s') }}
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-slate-800/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-700 hover:border-blue-500/50 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-400 mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="dollar-sign" class="w-7 h-7"></i>
                </div>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Total Revenue</p>
                <h3 class="text-3xl font-black tracking-tighter text-white">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-slate-800/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-700 hover:border-emerald-500/50 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="shopping-cart" class="w-7 h-7"></i>
                </div>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Total Bookings</p>
                <h3 class="text-3xl font-black tracking-tighter text-white">{{ $stats['total_bookings'] }}</h3>
            </div>
            <div class="bg-slate-800/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-700 hover:border-amber-500/50 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-400 mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="refresh-cw" class="w-7 h-7"></i>
                </div>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Pending Refunds</p>
                <h3 class="text-3xl font-black tracking-tighter text-white">{{ $stats['pending_refunds'] }}</h3>
            </div>
            <div class="bg-slate-800/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-700 hover:border-purple-500/50 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-purple-500/10 flex items-center justify-center text-purple-400 mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="users" class="w-7 h-7"></i>
                </div>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Total Travelers</p>
                <h3 class="text-3xl font-black tracking-tighter text-white">{{ $stats['total_users'] }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Navigation -->
            <div class="lg:col-span-3 space-y-4">
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-4 rounded-2xl bg-blue-600 text-white font-bold text-sm shadow-lg shadow-blue-500/20">
                        <i data-lucide="layout-grid" class="w-5 h-5"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.bookings') }}" class="flex items-center gap-3 p-4 rounded-2xl text-slate-400 hover:bg-slate-800 hover:text-white font-bold text-sm transition-all">
                        <i data-lucide="ticket" class="w-5 h-5"></i> Manage Bookings
                    </a>
                    <a href="{{ route('admin.destinations') }}" class="flex items-center gap-3 p-4 rounded-2xl text-slate-400 hover:bg-slate-800 hover:text-white font-bold text-sm transition-all">
                        <i data-lucide="map-pin" class="w-5 h-5"></i> Destinations
                    </a>
                </nav>
            </div>

            <!-- Recent Activity -->
            <div class="lg:col-span-9">
                <div class="bg-slate-800/30 backdrop-blur-md rounded-[3rem] border border-slate-700/50 overflow-hidden">
                    <div class="px-10 py-8 border-b border-slate-700/50 flex items-center justify-between">
                        <h3 class="text-xl font-bold tracking-tight">Recent Bookings</h3>
                        <a href="{{ route('admin.bookings') }}" class="text-sm font-bold text-blue-400 hover:text-blue-300">View All</a>
                    </div>
                    <div class="p-4 overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-500 text-[10px] uppercase tracking-widest font-black">
                                    <th class="px-6 py-4">Traveler</th>
                                    <th class="px-6 py-4">Destination</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/50">
                                @forelse($recent_bookings as $booking)
                                    <tr class="hover:bg-slate-800/50 transition-colors group">
                                        <td class="px-6 py-6">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-slate-700 flex items-center justify-center text-xs font-bold">
                                                    {{ substr($booking->user->name ?? 'G', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-200">{{ $booking->user->name ?? 'Guest' }}</p>
                                                    <p class="text-[10px] text-slate-500 uppercase font-mono tracking-tighter">#{{ $booking->booking_id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            <p class="font-bold text-slate-200">{{ $booking->destination->title }}</p>
                                            <p class="text-[10px] text-slate-500">{{ $booking->travel_date->format('M d, Y') }}</p>
                                        </td>
                                        <td class="px-6 py-6 font-black text-blue-400">
                                            {{ $booking->formatted_grand_total }}
                                        </td>
                                        <td class="px-6 py-6">
                                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-20 text-center text-slate-500 font-bold">
                                            No active bookings found.
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
