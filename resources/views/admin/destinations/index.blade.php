@extends('layouts.app')

@section('title', 'Manage Destinations - Admin GODuls')

@section('content')
<main class="pt-28 pb-20 bg-slate-950 min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-3xl font-black tracking-tight">Destination Inventory</h1>
                <p class="text-slate-500 mt-1">Add or remove travel packages from the platform.</p>
            </div>
            <a href="{{ route('admin.destinations.create') }}" class="btn-primary px-8 py-4 flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i> Add New Package
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($destinations as $dest)
                <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] overflow-hidden group hover:border-blue-500/50 transition-all">
                    <div class="relative h-56">
                        <img src="{{ $dest->image }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <span class="px-3 py-1 rounded-full bg-blue-600 text-[9px] font-black uppercase tracking-widest">{{ $dest->category }}</span>
                            <h3 class="text-xl font-bold mt-2 text-white">{{ $dest->title }}</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Base Price</p>
                                <p class="text-xl font-black text-blue-400">Rp {{ number_format($dest->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Rating</p>
                                <div class="flex items-center gap-1 text-amber-400">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <span class="font-bold">{{ $dest->rating }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <button class="flex-1 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-3 rounded-2xl text-xs transition-all cursor-not-allowed opacity-50">
                                Edit Details
                            </button>
                            <form action="{{ route('admin.destinations.delete', $dest->id) }}" method="POST" onsubmit="event.preventDefault(); confirmAction(this, 'Delete Package?', 'This will permanently remove this destination from the store.', 'danger')" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-12 h-12 rounded-2xl bg-slate-800 text-slate-500 hover:bg-red-600 hover:text-white flex items-center justify-center transition-all cursor-pointer">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
