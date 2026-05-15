<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GODuls - Your trusted travel partner for seamless booking experiences. Explore the world with confidence.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GODuls - Discover Your Next Great Adventure')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%233b82f6'/%3E%3Cstop offset='100%25' stop-color='%2322d3ee'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='24' height='24' rx='6' fill='url(%23g)'/%3E%3Cpath fill='none' stroke='%23ffffff' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' d='M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.2-1.1.6L3 8l5.5 3.5-5 1.5-2.5-1.5L4 15l4 4 1-2 1.5-2.5 5.5 2.5c.3.2.7 0 .8-.5l-1-1.8Z'/%3E%3C/svg%3E">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Font Awesome for Social Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 text-gray-900" style="font-family: 'Inter', sans-serif;">

    @include('layouts.header')

    <div id="app-content">
        @yield('content')
    </div>

    @include('layouts.footer')

    <!-- Lucide Icons Init -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });

        window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        function handleBookClick(event, url) {
            if (!window.isAuthenticated) {
                event.preventDefault();
                document.getElementById('auth-modal').classList.remove('hidden');
                document.getElementById('auth-modal').classList.add('flex');
                lucide.createIcons(); // refresh icons in modal
            }
        }
        
        function closeAuthModal() {
            document.getElementById('auth-modal').classList.add('hidden');
            document.getElementById('auth-modal').classList.remove('flex');
        }
    </script>

    <!-- Auth Modal -->
    <div id="auth-modal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl transform transition-all relative">
            <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="user-x" class="w-8 h-8 text-blue-500"></i>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Anda Belum Login</h3>
            <p class="text-center text-gray-500 mb-6 text-sm">Silahkan login terlebih dahulu untuk melanjutkan pemesanan tiket.</p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('login') }}" class="btn-primary text-center py-2.5 w-full">Login Sekarang</a>
                <p class="text-center text-xs text-gray-500 mt-2">
                    Belum punya akun? <br/><a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline mt-1 inline-block">Buat akun dulu yuk!</a>
                </p>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
