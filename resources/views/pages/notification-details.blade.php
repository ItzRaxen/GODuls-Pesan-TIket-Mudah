@extends('layouts.app')

@section('title', 'Notification Details - GODuls')

@section('content')
<main class="pt-28 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <a href="{{ route('notifications.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-600 transition-colors mb-6 text-sm font-medium">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Notifications
        </a>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8 md:p-12">
                <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-8">
                    <i data-lucide="mail" class="w-8 h-8"></i>
                </div>

                <div class="mb-8">
                    <span class="text-xs text-gray-400 font-bold uppercase tracking-widest block mb-2">Message</span>
                    <h1 class="text-2xl font-bold text-gray-900 leading-relaxed">
                        {{ $notification->data['message'] }}
                    </h1>
                </div>

                <div class="grid grid-cols-2 gap-8 py-8 border-y border-gray-50 mb-8">
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Received At</span>
                        <p class="text-sm font-bold text-gray-900">{{ $notification->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    @if(isset($notification->data['booking_id']))
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase font-bold block mb-1">Related Booking</span>
                            <p class="text-sm font-bold text-blue-600">#{{ $notification->data['booking_id'] }}</p>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col gap-3">
                    @if(isset($notification->data['url']))
                        <a href="{{ $notification->data['url'] }}" class="btn-primary w-full py-4 rounded-xl flex items-center justify-center gap-2">
                            View Activity <i data-lucide="external-link" class="w-4 h-4"></i>
                        </a>
                    @endif
                    
                    <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Delete Notification?', 'Are you sure you want to delete this notification?', 'danger')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-gray-50 text-gray-500 font-bold py-4 rounded-xl hover:bg-red-50 hover:text-red-500 transition-colors flex items-center justify-center gap-2 cursor-pointer">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> Delete Notification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
