<footer id="contact" class="bg-slate-950 text-white">
    <!-- Main footer -->
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
            <!-- Brand -->
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-5 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center">
                        <i data-lucide="plane" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight">GODuls</span>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Your trusted travel partner for seamless booking experiences. Explore the world with confidence.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 bg-white/5 hover:bg-blue-500 border border-white/10 hover:border-blue-500 rounded-xl flex items-center justify-center transition-all">
                        <i class="fab fa-facebook-f w-4 h-4 text-gray-400 hover:text-white text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 bg-white/5 hover:bg-blue-500 border border-white/10 hover:border-blue-500 rounded-xl flex items-center justify-center transition-all">
                        <i class="fab fa-twitter w-4 h-4 text-gray-400 hover:text-white text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 bg-white/5 hover:bg-blue-500 border border-white/10 hover:border-blue-500 rounded-xl flex items-center justify-center transition-all">
                        <i class="fab fa-instagram w-4 h-4 text-gray-400 hover:text-white text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-widest mb-5">Navigation</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm transition-colors hover:translate-x-1 transform inline-block">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('destinations.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors hover:translate-x-1 transform inline-block">Destinations</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#packages" class="text-gray-400 hover:text-white text-sm transition-colors hover:translate-x-1 transform inline-block">Packages</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#about" class="text-gray-400 hover:text-white text-sm transition-colors hover:translate-x-1 transform inline-block">About</a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-widest mb-5">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-gray-400 text-sm">
                        <i data-lucide="map-pin" class="w-4 h-4 text-blue-400 shrink-0 mt-0.5"></i>
                        <span>Jl. Sudirman No.123, Jakarta</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <i data-lucide="phone" class="w-4 h-4 text-blue-400 shrink-0"></i>
                        <span>+62 21 1234 5678</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <i data-lucide="mail" class="w-4 h-4 text-blue-400 shrink-0"></i>
                        <span>hello@ticketgo.id</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-widest mb-5">Newsletter</h4>
                <p class="text-gray-400 text-sm mb-4">Get exclusive deals and travel inspiration in your inbox.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-2">
                    @csrf
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        class="bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:border-blue-500 w-full text-sm placeholder:text-gray-500 transition-colors"
                    />
                    <button type="submit" class="btn-primary text-sm py-2.5">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row items-center justify-between text-sm text-gray-500">
            <p>© {{ date('Y') }} GODuls. All rights reserved.</p>
            <div class="flex gap-5 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
