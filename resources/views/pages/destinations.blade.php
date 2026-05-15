@extends('layouts.app')

@section('title', 'Explore All Destinations - GODuls')

@section('content')
<main class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-slate-900 to-blue-900 text-white pt-32 pb-16 px-6">
        <div class="max-w-7xl mx-auto">
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-2 text-blue-300 hover:text-white transition-colors mb-6 font-medium text-sm"
            >
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Home
            </a>
            <h1 class="text-4xl md:text-5xl font-bold mb-3" style="font-family: 'Poppins', sans-serif;">Explore All Destinations</h1>
            <p class="text-blue-200/70 max-w-xl">Find your perfect getaway from our curated collection of breathtaking locations.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Filters Row -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <!-- Category Pills -->
            <div class="flex flex-wrap gap-2" id="category-filters">
                @foreach(['All', 'Beach & Island', 'City Tour', 'Nature & Adventure'] as $cat)
                <button
                    onclick="filterByCategory('{{ $cat }}')"
                    data-category="{{ $cat }}"
                    class="category-pill px-5 py-2 rounded-full text-sm font-medium transition-all {{ (request('category', 'All') === $cat || ($cat === 'All' && !request('category'))) ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-300 hover:text-blue-600' }}"
                >
                    {{ $cat }}
                </button>
                @endforeach
            </div>

            <div class="flex items-center gap-2 relative">
                <!-- Filters Button -->
                <div class="relative">
                    <button
                        onclick="toggleFilterDropdown()"
                        id="filter-btn"
                        class="flex items-center gap-2 px-4 py-2 border rounded-xl text-sm font-medium transition-colors border-gray-200 hover:bg-gray-50"
                    >
                        <i data-lucide="filter" class="w-4 h-4"></i> Filters
                    </button>
                    <div id="filter-dropdown" class="hidden absolute top-full right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-5 z-20">
                        <h4 class="font-semibold text-gray-900 mb-4">Max Price</h4>
                        <div class="mb-2 flex justify-between text-sm font-medium text-blue-600">
                            <span>Rp 0</span>
                            <span id="price-display">Rp 15.000.000</span>
                        </div>
                        <input
                            type="range"
                            min="1000000"
                            max="15000000"
                            step="500000"
                            value="15000000"
                            class="w-full accent-blue-600"
                            id="price-range"
                            oninput="updatePriceFilter(this.value)"
                        />
                        <div class="mt-6 flex justify-end">
                            <button onclick="applyFilter()" class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">Apply Filter</button>
                        </div>
                    </div>
                </div>

                <!-- Sort Button -->
                <div class="relative">
                    <button
                        onclick="toggleSortDropdown()"
                        id="sort-btn"
                        class="flex items-center gap-2 px-4 py-2 border rounded-xl text-sm font-medium transition-colors border-gray-200 hover:bg-gray-50"
                    >
                        <span id="sort-label">Popular</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                    <div id="sort-dropdown" class="hidden absolute top-full right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-20 overflow-hidden">
                        @foreach([
                            ['id' => 'popular', 'label' => 'Most Popular'],
                            ['id' => 'price-low', 'label' => 'Price: Low to High'],
                            ['id' => 'price-high', 'label' => 'Price: High to Low'],
                            ['id' => 'rating', 'label' => 'Highest Rated'],
                        ] as $opt)
                        <button
                            onclick="setSortOption('{{ $opt['id'] }}', '{{ $opt['label'] }}')"
                            data-sort="{{ $opt['id'] }}"
                            class="sort-option w-full text-left px-5 py-2.5 text-sm transition-colors {{ $opt['id'] === 'popular' ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50' }}"
                        >
                            {{ $opt['label'] }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Destinations Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6" id="destinations-grid">
            <!-- Loading Shimmers -->
            @for($i = 0; $i < 8; $i++)
            <div class="rounded-2xl h-[360px] shimmer shimmer-placeholder"></div>
            @endfor
        </div>

        <!-- Empty State -->
        <div class="text-center py-24 hidden" id="empty-state">
            <i data-lucide="globe" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
            <p class="text-gray-400 text-lg font-medium">No destinations found.</p>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    let allDestinations = [];
    let activeCategory = 'All';
    let sortOption = 'popular';
    let maxPrice = 15000000;
    let filterOpen = false;
    let sortOpen = false;

    // Initialize from URL params
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    if (categoryParam) {
        activeCategory = categoryParam;
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', maximumFractionDigits: 0}).format(amount);
    }

    function renderDestinationCard(dest) {
        return `
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 card-hover group cursor-pointer shadow-sm hover:shadow-xl">
            <div class="relative overflow-hidden" style="height: 208px;">
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
                    <a href="/destinations/${dest.id}/booking" onclick="handleBookClick(event, this.href)" class="bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-xs px-3.5 py-2 rounded-xl transition-colors flex items-center gap-1 no-underline">
                        Book <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </div>`;
    }

    function renderGrid() {
        let filtered = allDestinations.filter(d => {
            const matchCat = activeCategory === 'All' || d.category === activeCategory;
            const matchPrice = d.price <= maxPrice;
            return matchCat && matchPrice;
        });

        filtered = [...filtered].sort((a, b) => {
            if (sortOption === 'price-low') return a.price - b.price;
            if (sortOption === 'price-high') return b.price - a.price;
            if (sortOption === 'rating') return b.rating - a.rating;
            return b.reviews - a.reviews;
        });

        const grid = document.getElementById('destinations-grid');
        const emptyState = document.getElementById('empty-state');

        if (filtered.length === 0) {
            grid.innerHTML = '';
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
            grid.innerHTML = filtered.map(d => renderDestinationCard(d)).join('');
        }
        lucide.createIcons();
    }

    function filterByCategory(cat) {
        activeCategory = cat;
        document.querySelectorAll('.category-pill').forEach(btn => {
            if (btn.dataset.category === cat) {
                btn.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
            }
        });
        renderGrid();
    }

    function toggleFilterDropdown() {
        filterOpen = !filterOpen;
        sortOpen = false;
        document.getElementById('filter-dropdown').classList.toggle('hidden', !filterOpen);
        document.getElementById('sort-dropdown').classList.add('hidden');
    }

    function toggleSortDropdown() {
        sortOpen = !sortOpen;
        filterOpen = false;
        document.getElementById('sort-dropdown').classList.toggle('hidden', !sortOpen);
        document.getElementById('filter-dropdown').classList.add('hidden');
    }

    function updatePriceFilter(val) {
        maxPrice = parseInt(val);
        document.getElementById('price-display').textContent = new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', maximumFractionDigits: 0}).format(maxPrice);
    }

    function applyFilter() {
        filterOpen = false;
        document.getElementById('filter-dropdown').classList.add('hidden');
        renderGrid();
    }

    function setSortOption(id, label) {
        sortOption = id;
        document.getElementById('sort-label').textContent = label;
        document.querySelectorAll('.sort-option').forEach(btn => {
            if (btn.dataset.sort === id) {
                btn.classList.add('bg-blue-50', 'text-blue-600', 'font-medium');
                btn.classList.remove('text-gray-700');
            } else {
                btn.classList.remove('bg-blue-50', 'text-blue-600', 'font-medium');
                btn.classList.add('text-gray-700');
            }
        });
        sortOpen = false;
        document.getElementById('sort-dropdown').classList.add('hidden');
        renderGrid();
    }

    // Load data
    fetch('/api/destinations')
        .then(r => r.json())
        .then(data => {
            allDestinations = data;
            if (categoryParam) {
                activeCategory = categoryParam;
            }
            renderGrid();
        });

    // Close dropdowns on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#filter-btn') && !e.target.closest('#filter-dropdown')) {
            filterOpen = false;
            document.getElementById('filter-dropdown').classList.add('hidden');
        }
        if (!e.target.closest('#sort-btn') && !e.target.closest('#sort-dropdown')) {
            sortOpen = false;
            document.getElementById('sort-dropdown').classList.add('hidden');
        }
    });
</script>
@endpush
