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

    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    @stack('scripts')

    <!-- Notification Toast Component (Top-Right) -->
    <div id="notification-toast" class="fixed top-24 right-6 z-[200] pointer-events-none opacity-0 translate-x-20 flex items-center gap-4 bg-white/90 backdrop-blur-xl border border-gray-100 rounded-2xl px-6 py-4 shadow-[0_20px_50px_rgba(0,0,0,0.1)] min-w-[350px]">
        <div id="toast-icon-bg" class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm">
            <i id="toast-icon" data-lucide="check" class="w-6 h-6"></i>
        </div>
        <div class="flex-1">
            <h4 id="toast-title" class="text-sm font-extrabold text-gray-900 tracking-tight">Success</h4>
            <p id="toast-message" class="text-xs text-gray-500 mt-0.5 leading-relaxed">Operation completed successfully.</p>
        </div>
        <button onclick="hideToast()" class="text-gray-300 hover:text-gray-500 transition-colors pointer-events-auto">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

    <!-- Global Confirmation Modal -->
    <div id="confirm-modal" class="fixed inset-0 z-[210] hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div id="confirm-card" class="bg-white rounded-[2.5rem] p-10 max-w-sm w-full mx-4 shadow-2xl opacity-0 scale-90 translate-y-10">
            <div id="confirm-icon-bg" class="w-20 h-20 bg-amber-50 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-sm">
                <i id="confirm-icon" data-lucide="alert-triangle" class="w-10 h-10 text-amber-500"></i>
            </div>
            <h3 id="confirm-title" class="text-2xl font-black text-center text-gray-900 mb-3 tracking-tight">Are you sure?</h3>
            <p id="confirm-message" class="text-center text-gray-500 mb-10 text-sm leading-relaxed px-2">This action cannot be undone. Please confirm to proceed.</p>
            
            <div class="grid grid-cols-2 gap-4">
                <button onclick="closeConfirmModal()" class="py-4 rounded-2xl bg-gray-50 text-gray-400 font-bold text-sm hover:bg-gray-100 transition-all cursor-pointer">
                    Cancel
                </button>
                <button id="confirm-btn-action" class="py-4 rounded-2xl bg-gray-900 text-white font-bold text-sm hover:shadow-xl hover:shadow-gray-900/20 transition-all cursor-pointer">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <script>
        let toastTimeout;
        let pendingForm = null;

        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('notification-toast');
            const iconBg = document.getElementById('toast-icon-bg');
            const icon = document.getElementById('toast-icon');
            const titleEl = document.getElementById('toast-title');
            const messageEl = document.getElementById('toast-message');

            if (toastTimeout) clearTimeout(toastTimeout);

            // Reset classes
            iconBg.className = 'w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm ';
            
            if (type === 'success') {
                iconBg.classList.add('bg-emerald-500', 'text-white');
                icon.setAttribute('data-lucide', 'check');
                titleEl.textContent = title || 'Action Successful';
            } else if (type === 'error') {
                iconBg.classList.add('bg-red-500', 'text-white');
                icon.setAttribute('data-lucide', 'alert-circle');
                titleEl.textContent = title || 'Something Went Wrong';
            } else {
                iconBg.classList.add('bg-blue-500', 'text-white');
                icon.setAttribute('data-lucide', 'info');
                titleEl.textContent = title || 'Notification';
            }

            messageEl.textContent = message;
            lucide.createIcons();

            gsap.to(toast, { 
                opacity: 1, 
                x: 0, 
                duration: 0.6, 
                ease: 'expo.out',
                pointerEvents: 'auto'
            });
            
            toastTimeout = setTimeout(hideToast, 5000);
        }

        function hideToast() {
            const toast = document.getElementById('notification-toast');
            gsap.to(toast, { 
                opacity: 0, 
                x: 50, 
                duration: 0.5, 
                ease: 'expo.in',
                pointerEvents: 'none'
            });
        }

        // Global Confirmation Logic
        function confirmAction(form, title = 'Are you sure?', message = 'This action cannot be undone.', type = 'warning') {
            pendingForm = form;
            const modal = document.getElementById('confirm-modal');
            const card = document.getElementById('confirm-card');
            const titleEl = document.getElementById('confirm-title');
            const messageEl = document.getElementById('confirm-message');
            const iconBg = document.getElementById('confirm-icon-bg');
            const icon = document.getElementById('confirm-icon');
            const confirmBtn = document.getElementById('confirm-btn-action');

            titleEl.textContent = title;
            messageEl.textContent = message;

            // Type styling
            if (type === 'danger') {
                iconBg.className = 'w-20 h-20 bg-red-50 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-sm';
                icon.className = 'w-10 h-10 text-red-500';
                icon.setAttribute('data-lucide', 'trash-2');
                confirmBtn.className = 'py-4 rounded-2xl bg-red-600 text-white font-bold text-sm hover:shadow-xl hover:shadow-red-600/20 transition-all cursor-pointer';
            } else {
                iconBg.className = 'w-20 h-20 bg-amber-50 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-sm';
                icon.className = 'w-10 h-10 text-amber-500';
                icon.setAttribute('data-lucide', 'alert-triangle');
                confirmBtn.className = 'py-4 rounded-2xl bg-gray-900 text-white font-bold text-sm hover:shadow-xl hover:shadow-gray-900/20 transition-all cursor-pointer';
            }

            lucide.createIcons();
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            gsap.to(card, {
                opacity: 1,
                scale: 1,
                y: 0,
                duration: 0.6,
                ease: 'expo.out'
            });

            confirmBtn.onclick = function() {
                if (pendingForm) pendingForm.submit();
            };
        }

        function closeConfirmModal() {
            const modal = document.getElementById('confirm-modal');
            const card = document.getElementById('confirm-card');
            
            gsap.to(card, {
                opacity: 0,
                scale: 0.9,
                y: 20,
                duration: 0.4,
                ease: 'expo.in',
                onComplete: () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    pendingForm = null;
                }
            });
        }

        // Auto-show session messages
        @if(session('success'))
            showToast('Success', '{{ session('success') }}', 'success');
        @endif
        @if(session('error'))
            showToast('Error', '{{ session('error') }}', 'error');
        @endif
        @if($errors->any())
            showToast('Validation Error', '{{ $errors->first() }}', 'error');
        @endif
    </script>
</body>
</html>
