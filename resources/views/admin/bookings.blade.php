@extends('layouts.app')

@section('title', 'Manage Bookings - Admin GODuls')

@section('content')
<main class="pt-28 pb-20 bg-slate-950 min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-12">
            <h1 class="text-3xl font-black tracking-tight">Booking Management</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-white flex items-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Back
                </a>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-800/50 text-[10px] font-black uppercase tracking-widest text-slate-500">
                            <th class="px-8 py-5">Order Info</th>
                            <th class="px-8 py-5">Traveler</th>
                            <th class="px-8 py-5">Destination</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-100">#{{ $booking->booking_id }}</p>
                                    <p class="text-[10px] text-slate-500 font-mono">{{ $booking->created_at->format('d/m/Y H:i') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-200">{{ $booking->user->name ?? 'Guest' }}</p>
                                    <p class="text-[10px] text-slate-500">{{ $booking->user->email ?? '-' }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-200">{{ $booking->destination->title }}</p>
                                    <p class="text-[10px] text-blue-400 font-black tracking-widest">{{ $booking->formatted_grand_total }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusStyles = [
                                            'confirmed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            'pending' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                            'refund_pending' => 'bg-purple-500/10 text-purple-400 border-purple-500/20 animate-pulse',
                                            'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                            'refunded' => 'bg-slate-700 text-slate-400',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusStyles[$booking->status] ?? 'bg-slate-800' }}">
                                        {{ str_replace('_', ' ', $booking->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($booking->status === 'refund_pending')
                                            <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Process Refund?', 'Mark this booking as fully refunded?', 'danger')" class="m-0">
                                                @csrf
                                                <input type="hidden" name="status" value="refunded">
                                                <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black px-4 py-2 rounded-xl transition-all cursor-pointer">
                                                    Approve Refund
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status === 'pending')
                                            <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Confirm Booking?', 'Approve this booking manually?')" class="m-0">
                                                @csrf
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black px-4 py-2 rounded-xl transition-all cursor-pointer">
                                                    Confirm
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Cancel Booking?', 'This will invalidate the ticket.', 'danger')" class="m-0">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-slate-800 text-slate-500 hover:bg-red-600 hover:text-white flex items-center justify-center transition-all cursor-pointer">
                                                <i data-lucide="x-circle" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-6 border-t border-slate-800 bg-slate-900/50">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</main>
@endsection
