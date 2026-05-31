@extends('layouts.app')

@section('title', 'Payment - GODuls')

@push('scripts')
<!-- Midtrans Snap (Sandbox) -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush


@section('content')
<main class="min-h-screen pt-32 pb-16 px-6 bg-gray-50">
    <div class="max-w-4xl mx-auto flex flex-col lg:flex-row gap-8 animate-fade-in-up">
        <!-- Payment Form -->
        <div class="flex-1">
            <a href="{{ route('booking.show', $destination['id']) }}" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Booking
            </a>

            <h1 class="text-3xl font-bold mb-8 text-gray-900">Payment Process</h1>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-6">
                <h2 class="text-xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                    <i data-lucide="credit-card" class="w-6 h-6 text-blue-500"></i> Payment Details
                </h2>

                <form action="{{ route('payment.process', $destination['id']) }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="date" value="{{ $booking['date'] }}" />
                    <input type="hidden" name="guests" value="{{ $booking['guests'] }}" />
                    <input type="hidden" name="midtrans_result" id="midtrans_result" value="" />

                    <div class="text-center py-8">
                        <i data-lucide="shield-check" class="w-16 h-16 text-green-500 mx-auto mb-4"></i>
                        <p class="text-gray-600 font-medium">Click the button below to proceed with our secure payment gateway.</p>
                    </div>

                    <button
                        type="button"
                        id="pay-button"
                        class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2"
                    >
                        <i data-lucide="lock" class="w-4 h-4"></i>
                        Pay {{ 'Rp ' . number_format($destination['price'] * $booking['guests'] * 1.1, 0, ',', '.') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:w-96">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-28">
                <h2 class="text-xl font-bold mb-4 text-gray-900 border-b pb-4">Order Summary</h2>

                <div class="flex gap-4 mb-6">
                    <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0">
                        <img src="{{ $destination['image'] }}" alt="{{ $destination['title'] }}" class="w-full h-full object-cover" />
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">{{ $destination['title'] }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $destination['category'] }}</p>
                    </div>
                </div>

                <div class="space-y-3 text-sm border-b pb-4 mb-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i data-lucide="calendar" class="w-4 h-4"></i> Date
                        </span>
                        <span class="font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($booking['date'])->format('d M Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i data-lucide="users" class="w-4 h-4"></i> Guests
                        </span>
                        <span class="font-semibold text-gray-900">{{ $booking['guests'] }}</span>
                    </div>
                </div>

                <div class="space-y-2 text-sm border-b pb-4 mb-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Price ({{ $booking['guests'] }}x)</span>
                        <span class="font-medium text-gray-900">
                            Rp {{ number_format($destination['price'] * $booking['guests'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Tax &amp; Fees</span>
                        <span class="font-medium text-gray-900">
                            Rp {{ number_format($destination['price'] * $booking['guests'] * 0.1, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="flex justify-between items-center text-lg">
                    <span class="font-bold text-gray-900">Total</span>
                    <span class="font-bold text-blue-600">
                        Rp {{ number_format($destination['price'] * $booking['guests'] * 1.1, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                document.getElementById('midtrans_result').value = JSON.stringify(result);
                document.getElementById('payment-form').submit();
            },
            onPending: function(result){
                document.getElementById('midtrans_result').value = JSON.stringify(result);
                document.getElementById('payment-form').submit();
            },
            onError: function(result){
                alert("Payment failed!");
                console.log(result);
            },
            onClose: function(){
                alert('You closed the popup without finishing the payment');
            }
        });
    };
</script>
@endpush
