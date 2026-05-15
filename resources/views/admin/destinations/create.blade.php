@extends('layouts.app')

@section('title', 'Add Destination - Admin GODuls')

@section('content')
<main class="pt-28 pb-20 bg-slate-950 min-h-screen text-white">
    <div class="max-w-3xl mx-auto px-6">
        <div class="flex items-center gap-4 mb-12">
            <a href="{{ route('admin.destinations') }}" class="w-12 h-12 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 hover:text-white transition-all">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black tracking-tight">New Package</h1>
                <p class="text-slate-500 mt-1">Deploy a new travel destination to the marketplace.</p>
            </div>
        </div>

        <form action="{{ route('admin.destinations.store') }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-[3rem] p-10 md:p-16 space-y-8">
            @csrf
            
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Package Title</label>
                <input type="text" name="title" required placeholder="e.g. Swiss Alps Expedition" class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-6 py-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Category</label>
                    <select name="category" required class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all appearance-none">
                        <option value="Beach & Island">Beach & Island</option>
                        <option value="City Tour">City Tour</option>
                        <option value="Nature & Adventure">Nature & Adventure</option>
                        <option value="Cultural Heritage">Cultural Heritage</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Base Price (IDR)</label>
                    <input type="number" name="price" required placeholder="5000000" class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-6 py-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Image URL (Unsplash or direct link)</label>
                <input type="url" name="image" required placeholder="https://images.unsplash.com/..." class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-6 py-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Description</label>
                <textarea name="description" rows="5" placeholder="Tell travelers about this magical place..." class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-6 py-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all"></textarea>
            </div>

            <button type="submit" class="btn-primary w-full py-5 rounded-2xl text-lg font-black tracking-widest uppercase hover:shadow-2xl hover:shadow-blue-600/30 transition-all">
                Publish Package
            </button>
        </form>
    </div>
</main>
@endsection
