@extends('layouts.app')

@section('title', 'Book ' . $destination['title'] . ' - GODuls')

@section('content')
<main class="min-h-screen pt-32 pb-16 px-6 bg-gray-50">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('destinations.index') }}" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back
        </a>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 animate-fade-in-up">
            <!-- Image header -->
            <div class="h-48 md:h-64 relative">
                <img src="{{ $destination['image'] }}" alt="{{ $destination['title'] }}" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-6 left-6 text-white">
                    <span class="text-sm font-medium bg-blue-600 px-3 py-1 rounded-full mb-2 inline-block">{{ $destination['category'] }}</span>
                    <h1 class="text-3xl font-bold">{{ $destination['title'] }}</h1>
                </div>
            </div>

            <div class="p-8">
                <h2 class="text-xl font-bold mb-6 text-gray-900 border-b pb-4">Booking Details</h2>

                <form action="{{ route('booking.store', $destination['id']) }}" method="POST" id="booking-form">
                    @csrf
                    <div class="space-y-6">
                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Select Date</label>
                            <div class="flex items-center gap-3 border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                                <i data-lucide="calendar" class="w-5 h-5 text-gray-400"></i>
                                <input
                                    type="date"
                                    name="date"
                                    id="booking-date"
                                    value="{{ old('date') }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    class="w-full bg-transparent outline-none text-gray-800 font-medium"
                                    required
                                />
                            </div>
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number of Guests -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Guests</label>
                            <div class="flex items-center gap-3 border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus-within:border-blue-500 transition-all">
                                <i data-lucide="users" class="w-5 h-5 text-gray-400"></i>
                                <div class="flex items-center justify-between w-full">
                                    <span class="text-gray-800 font-medium" id="guests-label">1 Guest</span>
                                    <div class="flex items-center gap-3">
                                        <button
                                            type="button"
                                            onclick="decreaseGuests()"
                                            class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition-colors text-gray-600 font-bold"
                                        >-</button>
                                        <input type="hidden" name="guests" id="guests-input" value="1" />
                                        <button
                                            type="button"
                                            onclick="increaseGuests()"
                                            class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition-colors text-gray-600 font-bold"
                                        >+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600 font-medium">Price per person</span>
                            <span class="text-gray-900 font-bold" id="price-per-person">{{ number_format($destination['price'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-lg mt-4 pt-4 border-t border-blue-200">
                            <span class="font-bold text-gray-900">Total Price</span>
                            <span class="font-bold text-blue-600 text-2xl" id="total-price">
                                Rp {{ number_format($destination['price'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <button
                        type="submit"
                        id="continue-btn"
                        disabled
                        class="w-full mt-8 py-4 rounded-xl font-bold text-white flex justify-center items-center gap-2 transition-all shadow-lg bg-gray-300 cursor-not-allowed shadow-none"
                    >
                        Continue to Payment <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const pricePerPerson = {{ $destination['price'] }};
    let guests = 1;

    function updateTotal() {
        const total = pricePerPerson * guests;
        document.getElementById('total-price').textContent = new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', maximumFractionDigits: 0}).format(total);
        document.getElementById('guests-label').textContent = guests + (guests === 1 ? ' Guest' : ' Guests');
        document.getElementById('guests-input').value = guests;
    }

    function increaseGuests() {
        guests++;
        updateTotal();
    }

    function decreaseGuests() {
        if (guests > 1) {
            guests--;
            updateTotal();
        }
    }

    document.getElementById('booking-date').addEventListener('change', function() {
        const btn = document.getElementById('continue-btn');
        if (this.value) {
            btn.disabled = false;
            btn.classList.remove('bg-gray-300', 'cursor-not-allowed', 'shadow-none');
            btn.classList.add('bg-blue-600', 'hover:bg-blue-700', 'shadow-blue-500/30');
        } else {
            btn.disabled = true;
            btn.classList.add('bg-gray-300', 'cursor-not-allowed', 'shadow-none');
            btn.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'shadow-blue-500/30');
        }
    });
</script>
@endpush
