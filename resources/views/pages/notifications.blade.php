@extends('layouts.app')

@section('title', 'Notifications - GODuls')

@section('content')
<main class="pt-28 pb-20 bg-gray-50/50 min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.2em] mb-3 block">Inbox</span>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Notifications</h1>
                <p class="text-gray-500 mt-2">Keep track of your booking updates and system alerts.</p>
            </div>
            <div class="flex items-center gap-3">
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form action="{{ route('notifications.markAllRead') }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Mark All as Read?', 'This will mark all your notifications as read.', 'info')" class="m-0">
                        @csrf
                        <button type="submit" class="bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold text-xs px-6 py-3 rounded-2xl transition-all flex items-center gap-2 cursor-pointer">
                            <i data-lucide="check-check" class="w-4 h-4"></i> Mark All as Read
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Notifications List -->
        <div class="space-y-4">
            @forelse($notifications as $notification)
                <div class="group bg-white rounded-[2rem] p-6 shadow-[0_10px_40px_rgba(0,0,0,0.02)] border border-gray-100 flex flex-col md:flex-row items-center gap-6 hover:shadow-[0_20px_50px_rgba(0,0,0,0.05)] transition-all relative overflow-hidden">
                    @if(!$notification->read_at)
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-600"></div>
                    @endif

                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 
                        {{ $notification->read_at ? 'bg-gray-50 text-gray-400' : 'bg-blue-50 text-blue-600 shadow-sm shadow-blue-500/10' }}">
                        <i data-lucide="{{ $notification->read_at ? 'mail-open' : 'mail' }}" class="w-6 h-6"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 text-center md:text-left min-w-0">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-2">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                                {{ $notification->created_at->format('d M Y • H:i') }}
                            </span>
                            <span class="text-[10px] font-bold text-gray-300">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 leading-relaxed truncate md:whitespace-normal">
                            {{ $notification->data['message'] }}
                        </h3>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('notifications.show', $notification->id) }}" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all" title="View Details">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                        
                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-all cursor-pointer" title="Mark as Read">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Delete Notification?', 'Are you sure you want to delete this notification?', 'danger')" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all cursor-pointer" title="Delete">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[3rem] py-24 text-center border border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="bell-off" class="w-10 h-10 text-gray-200"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Your inbox is empty</h3>
                    <p class="text-gray-400 max-w-xs mx-auto">When you receive updates about your bookings, they will appear here.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $notifications->links() }}
        </div>
    </div>
</main>
@endsection
