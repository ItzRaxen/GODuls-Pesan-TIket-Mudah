@extends('layouts.app')

@section('title', 'Book ' . $destination['title'] . ' - GODuls')

@section('content')
<main class="min-h-screen pt-32 pb-16 px-6 bg-gray-50">
    <div class="max-w-5xl mx-auto">
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
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- Left: Booking Form -->
                    <div>
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
                
                <!-- Right: Detailed Itinerary Timeline -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 h-fit shadow-sm">
                    <h3 class="text-xl font-bold mb-8 text-gray-900 flex items-center gap-3 border-b pb-4">
                        <i data-lucide="map" class="w-6 h-6 text-blue-600"></i> Detail Acara Tour (Itinerary)
                    </h3>
                    
                    <div class="relative border-l-[3px] border-blue-100 ml-4 space-y-8 pb-4">
                        <!-- Day 1 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[19px] top-0 w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm border-[4px] border-white shadow-md">1</div>
                            <h4 class="font-bold text-gray-900 text-lg mb-2 uppercase tracking-wide">Kedatangan di {{ $destination['title'] }} & Free Time</h4>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 text-sm text-gray-600 space-y-3 shadow-sm hover:shadow-md transition-shadow">
                                <p class="leading-relaxed">Hari ini Anda diharapkan berkumpul di Bandara Internasional untuk memulai perjalanan menuju <strong>{{ $destination['title'] }}</strong>. Setibanya di sana, Anda akan dijemput oleh perwakilan kami dan diantar ke hotel untuk proses <em>check-in</em>. Sisa hari ini adalah acara bebas <em>(free time)</em>.</p>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-semibold text-gray-500 pt-3 border-t border-gray-200 mt-3">
                                    <span class="flex items-center gap-1.5"><i data-lucide="hotel" class="w-4 h-4 text-blue-500"></i> Hotel Bintang 4</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="utensils-crossed" class="w-4 h-4 text-red-400"></i> Tidak Termasuk Makan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Day 2 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[19px] top-0 w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm border-[4px] border-white shadow-md">2</div>
                            <h4 class="font-bold text-gray-900 text-lg mb-2 uppercase tracking-wide">{{ $destination['title'] }} Highlights Tour</h4>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 text-sm text-gray-600 space-y-3 shadow-sm hover:shadow-md transition-shadow">
                                <p class="leading-relaxed">Setelah santap pagi di hotel, perjalanan dimulai dengan mengunjungi landmark ikonik yang menjadi daya tarik utama <strong>{{ $destination['title'] }}</strong>.</p>
                                <ul class="list-disc list-inside mt-2 space-y-1.5 ml-1 text-gray-700">
                                    <li>Kunjungan ke monumen bersejarah dan pusat kebudayaan lokal.</li>
                                    <li>Menikmati panorama indah dan <em>photo stop</em> di area wisata populer.</li>
                                    <li>Waktu bebas untuk berbelanja suvenir di pusat keramaian.</li>
                                </ul>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-semibold text-gray-500 pt-3 border-t border-gray-200 mt-3">
                                    <span class="flex items-center gap-1.5"><i data-lucide="hotel" class="w-4 h-4 text-blue-500"></i> Hotel Bintang 4</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="coffee" class="w-4 h-4 text-green-500"></i> Sarapan, Makan Siang</span>
                                </div>
                            </div>
                        </div>

                        <!-- Day 3 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[19px] top-0 w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm border-[4px] border-white shadow-md">3</div>
                            <h4 class="font-bold text-gray-900 text-lg mb-2 uppercase tracking-wide">Nature & Leisure Experience</h4>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 text-sm text-gray-600 space-y-3 shadow-sm hover:shadow-md transition-shadow">
                                <p class="leading-relaxed">Hari ketiga didedikasikan untuk menikmati keindahan alam dan suasana otentik {{ $destination['title'] }}. Anda akan diajak menyusuri pedesaan, menikmati udara segar di pegunungan, atau bersantai di pantai eksotis (bergantung pada lokasi).</p>
                                <p class="leading-relaxed">Malam harinya, Anda akan dijamu dengan makan malam spesial masakan lokal khas daerah tersebut.</p>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-semibold text-gray-500 pt-3 border-t border-gray-200 mt-3">
                                    <span class="flex items-center gap-1.5"><i data-lucide="hotel" class="w-4 h-4 text-blue-500"></i> Hotel Bintang 4</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="utensils" class="w-4 h-4 text-green-500"></i> Sarapan, Makan Siang, Makan Malam</span>
                                </div>
                            </div>
                        </div>

                        <!-- Day 4 -->
                        <div class="relative pl-8">
                            <div class="absolute -left-[19px] top-0 w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm border-[4px] border-white shadow-md">4</div>
                            <h4 class="font-bold text-gray-900 text-lg mb-2 uppercase tracking-wide">Kepulangan (Transfer Out)</h4>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 text-sm text-gray-600 space-y-3 shadow-sm hover:shadow-md transition-shadow">
                                <p class="leading-relaxed">Setelah santap pagi, Anda memiliki waktu bebas hingga tiba waktunya <em>check-out</em> hotel. Selanjutnya, tim kami akan mengantar Anda menuju bandara untuk penerbangan kembali pulang.</p>
                                <p class="font-medium text-blue-600 mt-2 text-xs italic">Terima kasih atas partisipasinya dan sampai bertemu di program tour kami lainnya!</p>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-semibold text-gray-500 pt-3 border-t border-gray-200 mt-3">
                                    <span class="flex items-center gap-1.5"><i data-lucide="plane-takeoff" class="w-4 h-4 text-purple-500"></i> Penerbangan Sore/Malam</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="coffee" class="w-4 h-4 text-green-500"></i> Termasuk Sarapan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
