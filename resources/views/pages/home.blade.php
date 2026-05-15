@extends('layouts.app')

@section('title', 'GODuls - Discover Your Next Great Adventure')

@section('content')
<main>
    <!-- ==================== HERO SECTION ==================== -->
    <section class="hero-section">
        <!-- Background gradient -->
        <div class="hero-bg"></div>

        <!-- Airplane image overlay -->
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&q=80&w=1920'); opacity: 0.35;"
        ></div>

        <!-- Sky gradient overlay -->
        <div
            class="absolute inset-0"
            style="background: linear-gradient(to bottom, rgba(15,23,42,0.5) 0%, rgba(14,40,80,0.55) 40%, rgba(15,23,42,0.85) 100%);"
        ></div>

        <!-- Decorative circles -->
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 left-1/4 w-72 h-72 bg-cyan-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full pt-28 pb-16">
            <div class="max-w-3xl">
                <!-- Trust badge -->
                <div class="trust-badge mb-8 animate-fade-in-up w-fit">
                    <div class="flex -space-x-1">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 border-2 border-white/30"></div>
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 border-2 border-white/30"></div>
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 border-2 border-white/30"></div>
                    </div>
                    <span>Trusted by 500K+ travelers worldwide</span>
                </div>

                <!-- Headline -->
                <h1
                    class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-up"
                    style="animation-delay: 0.1s; font-family: 'Poppins', sans-serif;"
                >
                    Discover Your Next
                    <span class="block" style="background: linear-gradient(135deg, #60a5fa, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Great Adventure
                    </span>
                </h1>

                <p
                    class="text-blue-100/80 text-lg md:text-xl max-w-xl leading-relaxed mb-10 animate-fade-in-up"
                    style="animation-delay: 0.2s;"
                >
                    Book flights, hotels, and curated experiences with our seamless travel platform. Your journey begins here.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 mb-14 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="{{ route('destinations.index') }}" class="btn-primary">
                        Explore Destinations
                    </a>
                    <a href="#about" class="btn-ghost">
                        How It Works
                    </a>
                </div>

                <!-- Stats Row -->
                <div class="flex flex-wrap gap-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="stat-glass">
                        <div class="text-xl font-bold text-white">500K+</div>
                        <div class="text-blue-200/70 text-xs mt-0.5">Happy Travelers</div>
                    </div>
                    <div class="stat-glass">
                        <div class="text-xl font-bold text-white">180+</div>
                        <div class="text-blue-200/70 text-xs mt-0.5">Destinations</div>
                    </div>
                    <div class="stat-glass">
                        <div class="text-xl font-bold text-white">4.9★</div>
                        <div class="text-blue-200/70 text-xs mt-0.5">Average Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 80H1440V20C1200 70 960 5 720 40C480 75 240 10 0 50V80Z" fill="#f9fafb" />
            </svg>
        </div>
    </section>

    <!-- ==================== POPULAR DESTINATIONS ==================== -->
    <section id="destinations" class="py-24 px-6 max-w-7xl mx-auto">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="text-blue-500 font-semibold text-sm uppercase tracking-widest mb-2 block">Explore</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Popular Destinations</h2>
                <p class="text-gray-500 mt-2 max-w-md">Handpicked destinations loved by thousands of travelers worldwide.</p>
            </div>
            <a
                href="{{ route('destinations.index') }}"
                class="hidden md:flex items-center gap-2 text-blue-500 font-semibold hover:gap-3 transition-all text-sm"
            >
                View All <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="home-destinations">
            <!-- Loading shimmer -->
            <div class="rounded-2xl h-[400px] shimmer" id="shimmer-1"></div>
            <div class="rounded-2xl h-[400px] shimmer" id="shimmer-2"></div>
            <div class="rounded-2xl h-[400px] shimmer" id="shimmer-3"></div>
        </div>

        <div class="flex justify-center mt-10 md:hidden">
            <a href="{{ route('destinations.index') }}" class="btn-primary">
                View All Destinations
            </a>
        </div>
    </section>

    <!-- ==================== CATEGORIES ==================== -->
    <section id="packages" class="py-16 bg-slate-900 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <span class="text-blue-400 font-semibold text-sm uppercase tracking-widest mb-2 block">Collections</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Explore by Style</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Beach Escapes -->
                <a href="{{ route('destinations.index') }}?category=Beach+%26+Island" class="relative rounded-2xl overflow-hidden h-72 cursor-pointer group block">
                    <img
                        src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=800"
                        alt="Beach Escapes"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <span class="text-blue-300 text-xs font-semibold mb-1">24 Packages</span>
                        <h3 class="text-xl font-bold text-white mb-1">Beach Escapes</h3>
                        <p class="text-white/60 text-sm mb-4">Crystal waters, white sands, and endless sunsets.</p>
                        <span class="text-white font-semibold text-sm flex items-center gap-1.5 group-hover:gap-3 transition-all">
                            Explore <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- City Tours -->
                <a href="{{ route('destinations.index') }}?category=City+Tour" class="relative rounded-2xl overflow-hidden h-72 cursor-pointer group block">
                    <img
                        src="https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&q=80&w=800"
                        alt="City Tours"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <span class="text-blue-300 text-xs font-semibold mb-1">36 Packages</span>
                        <h3 class="text-xl font-bold text-white mb-1">City Tours</h3>
                        <p class="text-white/60 text-sm mb-4">Immerse yourself in the culture of vibrant metropolises.</p>
                        <span class="text-white font-semibold text-sm flex items-center gap-1.5 group-hover:gap-3 transition-all">
                            Explore <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- Nature Retreats -->
                <a href="{{ route('destinations.index') }}?category=Nature+%26+Adventure" class="relative rounded-2xl overflow-hidden h-72 cursor-pointer group block">
                    <img
                        src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=800"
                        alt="Nature Retreats"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <span class="text-blue-300 text-xs font-semibold mb-1">18 Packages</span>
                        <h3 class="text-xl font-bold text-white mb-1">Nature Retreats</h3>
                        <p class="text-white/60 text-sm mb-4">Reconnect with nature in breathtaking landscapes.</p>
                        <span class="text-white font-semibold text-sm flex items-center gap-1.5 group-hover:gap-3 transition-all">
                            Explore <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ==================== FEATURES / ABOUT ==================== -->
    <section id="about" class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-blue-500 font-semibold text-sm uppercase tracking-widest mb-2 block">Why GODuls</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Travel Smarter, Not Harder
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto">We take care of every detail so you can focus on what matters — the journey.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1: Secure Payment -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 card-hover shadow-sm group">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="credit-card" class="w-6 h-6 text-blue-500"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">Secure Payment</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Multiple payment options with industry-grade encryption. Book with confidence.</p>
                    <div class="flex items-center gap-2 mt-5 text-xs text-gray-400">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
                        <span>Verified &amp; trusted</span>
                    </div>
                </div>

                <!-- Feature 2: Price Guarantee -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 card-hover shadow-sm group">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="shield-check" class="w-6 h-6 text-emerald-500"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">Price Guarantee</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">We guarantee the best rates or we'll refund the difference. No questions asked.</p>
                    <div class="flex items-center gap-2 mt-5 text-xs text-gray-400">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
                        <span>Verified &amp; trusted</span>
                    </div>
                </div>

                <!-- Feature 3: 24/7 Support -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 card-hover shadow-sm group">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="headset" class="w-6 h-6 text-purple-500"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">24/7 Support</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Our travel experts are always available to assist you, anywhere in the world.</p>
                    <div class="flex items-center gap-2 mt-5 text-xs text-gray-400">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
                        <span>Verified &amp; trusted</span>
                    </div>
                </div>
            </div>

            <!-- CTA Strip -->
            <div class="mt-16 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-2">Ready for your next adventure?</h3>
                    <p class="text-blue-100 text-sm">Join over 500,000 happy travelers who trust GODuls.</p>
                </div>
                <a
                    href="{{ route('destinations.index') }}"
                    class="bg-white text-blue-600 font-bold px-8 py-4 rounded-xl hover:bg-blue-50 transition-colors whitespace-nowrap shadow-xl flex items-center gap-2"
                >
                    Start Planning <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    // Load destinations via AJAX for home page
    fetch('/api/destinations?limit=3')
        .then(r => r.json())
        .then(destinations => {
            const container = document.getElementById('home-destinations');
            // Remove shimmers
            container.innerHTML = '';
            destinations.forEach(dest => {
                container.innerHTML += renderDestinationCard(dest);
            });
            lucide.createIcons();
        });

    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', maximumFractionDigits: 0}).format(amount);
    }

    function renderDestinationCard(dest) {
        return `
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 card-hover group cursor-pointer shadow-sm hover:shadow-xl">
            <div class="relative overflow-hidden h-52">
                <img src="${dest.image}" alt="${dest.title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm rounded-lg px-2.5 py-1 flex items-center gap-1 text-xs font-semibold text-gray-800">
                    <i data-lucide="star" class="w-3 h-3 text-amber-400 fill-amber-400"></i> ${dest.rating}
                </div>
                <div class="absolute bottom-3 left-3">
                    <span class="text-xs text-white/80 bg-black/30 backdrop-blur-sm rounded-full px-2.5 py-0.5 flex items-center gap-1">
                        <i data-lucide="map-pin" class="w-2.5 h-2.5"></i> ${dest.category}
                    </span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-base font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">${dest.title}</h3>
                <p class="text-xs text-gray-400 mb-3">${dest.reviews.toLocaleString()} reviews</p>
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs text-gray-400 block">Starting from</span>
                        <span class="font-bold text-blue-600 text-sm">${formatCurrency(dest.price)}</span>
                    </div>
                    <a href="/destinations/${dest.id}/booking" onclick="handleBookClick(event, this.href)" class="bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-xs px-3.5 py-2 rounded-xl transition-colors flex items-center gap-1">
                        Book <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </div>`;
    }
</script>
@endpush
