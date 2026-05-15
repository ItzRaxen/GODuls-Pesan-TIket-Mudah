@extends('layouts.app')

@section('title', 'Payment - GODuls')

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

                    <div class="space-y-4">
                        <!-- Cardholder Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Cardholder Name</label>
                            <input
                                type="text"
                                name="cardholder_name"
                                placeholder="John Doe"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all font-medium text-gray-800"
                                required
                            />
                            @error('cardholder_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Card Number -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Card Number</label>
                            <input
                                type="text"
                                name="card_number"
                                placeholder="0000 0000 0000 0000"
                                maxlength="19"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all font-medium text-gray-800"
                                oninput="formatCardNumber(this)"
                                required
                            />
                            @error('card_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Expiry & CVC -->
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Expiry Date</label>
                                <input
                                    type="text"
                                    name="expiry"
                                    placeholder="MM/YY"
                                    maxlength="5"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all font-medium text-gray-800"
                                    oninput="formatExpiry(this)"
                                    required
                                />
                                @error('expiry')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">CVC</label>
                                <input
                                    type="text"
                                    name="cvc"
                                    placeholder="123"
                                    maxlength="3"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all font-medium text-gray-800"
                                    required
                                />
                                @error('cvc')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2"
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
    function formatCardNumber(input) {
        let val = input.value.replace(/\D/g, '').substring(0, 16);
        val = val.replace(/(.{4})/g, '$1 ').trim();
        input.value = val;
    }

    function formatExpiry(input) {
        let val = input.value.replace(/\D/g, '').substring(0, 4);
        if (val.length >= 2) {
            val = val.substring(0, 2) + '/' + val.substring(2);
        }
        input.value = val;
    }
</script>
@endpush
