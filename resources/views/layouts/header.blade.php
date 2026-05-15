<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" id="main-header">
    <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-blue-500/40 transition-shadow">
                <i data-lucide="plane" class="w-5 h-5 text-white"></i>
            </div>
            <span class="text-xl font-bold text-white tracking-tight">GODuls</span>
        </a>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('home') }}"
               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white/15 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                Home
            </a>
            <a href="{{ route('destinations.index') }}"
               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('destinations*') ? 'bg-white/15 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                Destinations
            </a>
            <a href="{{ route('home') }}#packages"
               class="px-4 py-2 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all">
                Packages
            </a>
            <a href="{{ route('home') }}#about"
               class="px-4 py-2 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all">
                About
            </a>
            <a href="{{ route('home') }}#contact"
               class="px-4 py-2 rounded-lg text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all">
                Contact
            </a>
        </div>

        <!-- CTA Desktop -->
        <div class="hidden md:flex items-center gap-3">
            <!-- Search -->
            <div class="relative" id="search-container">
                <div id="search-bar"
                     class="flex items-center bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg px-3 py-2 transition-all duration-300 ease-in-out overflow-hidden w-10 cursor-pointer"
                     onclick="openSearch()">
                    <i data-lucide="search" class="w-4 h-4 text-white flex-shrink-0"></i>
                    <input
                        id="search-input"
                        type="text"
                        placeholder="Search destination..."
                        class="bg-transparent border-none outline-none text-sm text-white placeholder:text-white/50 transition-all duration-300 ease-in-out w-0 opacity-0 ml-0 p-0"
                        oninput="handleSearch(this.value)"
                        onblur="setTimeout(closeSearch, 200)"
                    />
                    <button id="search-close" onclick="event.stopPropagation(); closeSearch();" class="ml-2 text-white/50 hover:text-white flex-shrink-0 hidden">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Search Dropdown -->
                <div id="search-dropdown"
                     class="absolute top-full right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col transition-all duration-300 origin-top-right opacity-0 scale-95 -translate-y-2 pointer-events-none">
                    <div class="px-4 py-3 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                        <span class="text-xs font-semibold text-gray-500 uppercase flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-3 h-3"></i> Results
                        </span>
                        <span class="text-xs text-gray-400" id="search-count">0 found</span>
                    </div>
                    <div class="max-h-96 overflow-y-auto" id="search-results-container">
                        <div class="p-6 text-center text-gray-500 text-sm" id="search-empty">
                            No destinations found.
                        </div>
                    </div>
                </div>
            </div>

            @guest
            <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all">
                <i data-lucide="user" class="w-4 h-4"></i>
                Sign In
            </a>
            @else
            <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                @csrf
                <button type="submit" class="flex items-center gap-2 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all cursor-pointer">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
            @endguest
            <a href="{{ route('destinations.index') }}" class="btn-primary text-sm py-2 px-5">
                Book Now
            </a>
        </div>

        <!-- Mobile Toggle -->
        <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg text-white hover:bg-white/10 transition-colors" id="mobile-toggle">
            <i data-lucide="menu" class="w-6 h-6" id="mobile-icon-menu"></i>
            <i data-lucide="x" class="w-6 h-6 hidden" id="mobile-icon-x"></i>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-slate-900/98 backdrop-blur-xl border-t border-white/10 px-6 py-4 flex-col gap-2">
        <!-- Mobile Search -->
        <div class="relative mb-2 mt-1">
            <div class="flex items-center bg-white/5 border border-white/10 rounded-lg px-3 py-2.5">
                <i data-lucide="search" class="w-4 h-4 text-white/50 mr-2"></i>
                <input
                    type="text"
                    placeholder="Search destination..."
                    class="bg-transparent border-none outline-none text-sm text-white w-full placeholder:text-white/40"
                    oninput="handleMobileSearch(this.value)"
                    id="mobile-search-input"
                />
            </div>
            <div id="mobile-search-results" class="absolute top-full left-0 right-0 mt-2 bg-slate-800 rounded-xl shadow-xl border border-white/10 overflow-hidden flex-col z-50 hidden">
                <div class="max-h-60 overflow-y-auto" id="mobile-search-results-inner">
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="text-white/80 hover:text-white text-left px-4 py-2.5 rounded-lg hover:bg-white/10 transition-all text-sm font-medium block">Home</a>
        <a href="{{ route('destinations.index') }}" class="text-white/80 hover:text-white text-left px-4 py-2.5 rounded-lg hover:bg-white/10 transition-all text-sm font-medium block">Destinations</a>
        <a href="{{ route('home') }}#packages" class="text-white/80 hover:text-white text-left px-4 py-2.5 rounded-lg hover:bg-white/10 transition-all text-sm font-medium block">Packages</a>
        <a href="{{ route('home') }}#about" class="text-white/80 hover:text-white text-left px-4 py-2.5 rounded-lg hover:bg-white/10 transition-all text-sm font-medium block">About</a>
        <a href="{{ route('home') }}#contact" class="text-white/80 hover:text-white text-left px-4 py-2.5 rounded-lg hover:bg-white/10 transition-all text-sm font-medium block">Contact</a>
        <a href="{{ route('destinations.index') }}" class="btn-primary text-sm mt-2">Book Now</a>
    </div>
</header>

<script>
    // All destinations data for search
    const allDestinationsData = @json(\App\Http\Controllers\DestinationController::getDestinationsData());

    const isHomePage = {{ request()->routeIs('home') ? 'true' : 'false' }};

    // Header scroll behavior
    window.addEventListener('scroll', function() {
        const header = document.getElementById('main-header');
        const scrolled = window.scrollY > 20;
        const isDark = scrolled || !isHomePage;
        if (isDark) {
            header.classList.add('bg-slate-900/95', 'backdrop-blur-xl', 'shadow-2xl');
            header.classList.remove('bg-transparent');
        } else {
            header.classList.remove('bg-slate-900/95', 'backdrop-blur-xl', 'shadow-2xl');
            header.classList.add('bg-transparent');
        }
    });

    // Initialize header state
    (function() {
        const header = document.getElementById('main-header');
        if (!isHomePage) {
            header.classList.add('bg-slate-900/95', 'backdrop-blur-xl', 'shadow-2xl');
        } else {
            header.classList.add('bg-transparent');
        }
    })();

    // Mobile menu
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('mobile-icon-menu');
        const iconX = document.getElementById('mobile-icon-x');
        const isOpen = !menu.classList.contains('hidden');

        if (isOpen) {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
            iconMenu.classList.remove('hidden');
            iconX.classList.add('hidden');
        } else {
            menu.classList.remove('hidden');
            menu.classList.add('flex');
            iconMenu.classList.add('hidden');
            iconX.classList.remove('hidden');
        }
    }

    // Desktop search
    let searchOpen = false;

    function openSearch() {
        if (!searchOpen) {
            searchOpen = true;
            const bar = document.getElementById('search-bar');
            const input = document.getElementById('search-input');
            const closeBtn = document.getElementById('search-close');
            bar.classList.remove('w-10', 'cursor-pointer');
            bar.classList.add('w-64');
            input.classList.remove('w-0', 'opacity-0', 'ml-0', 'p-0');
            input.classList.add('w-full', 'opacity-100', 'ml-2');
            closeBtn.classList.remove('hidden');
            setTimeout(() => input.focus(), 50);
        }
    }

    function closeSearch() {
        searchOpen = false;
        const bar = document.getElementById('search-bar');
        const input = document.getElementById('search-input');
        const closeBtn = document.getElementById('search-close');
        const dropdown = document.getElementById('search-dropdown');

        bar.classList.add('w-10', 'cursor-pointer');
        bar.classList.remove('w-64');
        input.classList.add('w-0', 'opacity-0', 'ml-0', 'p-0');
        input.classList.remove('w-full', 'opacity-100', 'ml-2');
        closeBtn.classList.add('hidden');
        input.value = '';

        dropdown.classList.add('opacity-0', 'scale-95', '-translate-y-2', 'pointer-events-none');
        dropdown.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
    }

    function handleSearch(query) {
        const dropdown = document.getElementById('search-dropdown');
        const container = document.getElementById('search-results-container');
        const countEl = document.getElementById('search-count');
        const empty = document.getElementById('search-empty');

        if (!query) {
            dropdown.classList.add('opacity-0', 'scale-95', '-translate-y-2', 'pointer-events-none');
            dropdown.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
            return;
        }

        const results = allDestinationsData.filter(d =>
            d.title.toLowerCase().includes(query.toLowerCase()) ||
            d.category.toLowerCase().includes(query.toLowerCase())
        );

        dropdown.classList.remove('opacity-0', 'scale-95', '-translate-y-2', 'pointer-events-none');
        dropdown.classList.add('opacity-100', 'scale-100', 'translate-y-0');

        countEl.textContent = results.length + ' found';

        if (results.length > 0) {
            empty.classList.add('hidden');
            let html = '';
            results.forEach(dest => {
                html += `<a href="/destinations/${dest.id}/booking" onclick="handleBookClick(event, this.href)" class="flex items-center gap-3 p-3 hover:bg-gray-50 cursor-pointer transition-colors border-b border-gray-50 last:border-b-0 block no-underline">
                    <img src="${dest.image}" alt="${dest.title}" class="w-12 h-12 rounded-lg object-cover flex-shrink-0" />
                    <div>
                        <h4 class="text-sm font-bold text-gray-900">${dest.title}</h4>
                        <span class="text-xs text-blue-600 font-medium">${dest.category}</span>
                    </div>
                </a>`;
            });
            container.innerHTML = html;
        } else {
            empty.classList.remove('hidden');
            container.innerHTML = document.getElementById('search-empty').outerHTML;
        }
    }

    function handleMobileSearch(query) {
        const resultsDiv = document.getElementById('mobile-search-results');
        const inner = document.getElementById('mobile-search-results-inner');

        if (!query) {
            resultsDiv.classList.add('hidden');
            resultsDiv.classList.remove('flex');
            return;
        }

        const results = allDestinationsData.filter(d =>
            d.title.toLowerCase().includes(query.toLowerCase()) ||
            d.category.toLowerCase().includes(query.toLowerCase())
        );

        if (results.length > 0) {
            resultsDiv.classList.remove('hidden');
            resultsDiv.classList.add('flex');
            let html = '';
            results.forEach(dest => {
                html += `<a href="/destinations/${dest.id}/booking" onclick="handleBookClick(event, this.href)" class="flex items-center gap-3 p-3 hover:bg-white/5 cursor-pointer transition-colors border-b border-white/5 last:border-b-0 block no-underline">
                    <img src="${dest.image}" alt="${dest.title}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0" />
                    <div>
                        <h4 class="text-sm font-medium text-white">${dest.title}</h4>
                        <span class="text-xs text-blue-300/70">${dest.category}</span>
                    </div>
                </a>`;
            });
            inner.innerHTML = html;
        } else {
            resultsDiv.classList.remove('hidden');
            resultsDiv.classList.add('flex');
            inner.innerHTML = '<div class="p-4 text-center text-white/50 text-sm">No matching destinations.</div>';
        }
    }
</script>
