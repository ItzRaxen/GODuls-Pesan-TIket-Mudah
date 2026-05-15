@extends('layouts.app')

@section('content')
<div class="min-h-screen relative flex items-center justify-center pt-24 pb-12 px-4 sm:px-6 lg:px-8 bg-slate-900">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=2021&auto=format&fit=crop" alt="Travel Background" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/90"></div>
    </div>

    <!-- Glassmorphism Card -->
    <div class="relative z-10 w-full max-w-md bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl shadow-2xl p-8 sm:p-10 animate-[fadeInUp_0.6s_ease-out]">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg mx-auto mb-4">
                <i data-lucide="plane" class="w-6 h-6 text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-white tracking-tight">Welcome Back</h2>
            <p class="text-blue-200/80 mt-2 text-sm">Sign in to continue your adventure</p>
        </div>

        @if(session('success'))
        <div class="mb-4 bg-green-500/20 border border-green-500/50 text-green-200 text-sm px-4 py-3 rounded-xl flex items-center">
            <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 bg-red-500/20 border border-red-500/50 text-red-200 text-sm px-4 py-3 rounded-xl flex items-start">
            <i data-lucide="alert-circle" class="w-5 h-5 mr-2 shrink-0 mt-0.5"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf
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
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-sm font-medium text-white/90">Password</label>
                    <a href="#" class="text-xs font-medium text-cyan-400 hover:text-cyan-300 transition-colors">Forgot password?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="lock" class="w-5 h-5 text-white/40"></i>
                    </div>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-xl bg-white/5 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all sm:text-sm">
                </div>
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                Sign In
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-white/60">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-cyan-400 hover:text-cyan-300 transition-colors">Register now</a>
        </p>
    </div>
</div>
@endsection
