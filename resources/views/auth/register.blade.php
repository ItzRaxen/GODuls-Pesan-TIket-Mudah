@extends('layouts.app')

@section('content')
<div class="min-h-screen relative flex items-center justify-center pt-24 pb-12 px-4 sm:px-6 lg:px-8 bg-slate-900">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop" alt="Travel Background" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/90"></div>
    </div>

    <!-- Glassmorphism Card -->
    <div class="relative z-10 w-full max-w-md bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl shadow-2xl p-8 sm:p-10 animate-[fadeInUp_0.6s_ease-out]">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white tracking-tight">Join GODuls</h2>
            <p class="text-blue-200/80 mt-2 text-sm">Start your next great adventure today</p>
        </div>

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
            @csrf
            
            <!-- Username Field -->
            <div>
                <label for="username" class="block text-sm font-medium text-white/90 mb-1.5">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="user" class="w-5 h-5 text-white/40"></i>
                    </div>
                    <input type="text" name="username" id="username" required placeholder="johndoe"
                        class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all sm:text-sm">
                </div>
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-white/90 mb-1.5">Email Account</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="mail" class="w-5 h-5 text-white/40"></i>
                    </div>
                    <input type="email" name="email" id="email" required placeholder="your.email@gmail.com"
                        class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all sm:text-sm">
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-white/90 mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="lock" class="w-5 h-5 text-white/40"></i>
                    </div>
                    <input type="password" name="password" id="password" required placeholder="Any combination you like"
                        class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all sm:text-sm">
                </div>
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                Create Account
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-white/60">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-cyan-400 hover:text-cyan-300 transition-colors">Sign in</a>
        </p>
    </div>
</div>
@endsection
