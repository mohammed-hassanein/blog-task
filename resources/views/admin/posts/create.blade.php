@extends('layouts.app')

@section('title', 'Admin - Create Post')

@section('content')
<div class="max-w-3xl mx-auto relative z-10">
    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">Create New Post</h1>
        <p class="text-slate-500 font-medium text-lg">Share your thoughts and ideas with the world.</p>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ route('admin.posts.store') }}" class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 md:p-12 space-y-8 relative overflow-hidden">
        @csrf
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-indigo-50 to-transparent rounded-bl-full -z-10 opacity-60"></div>

        <!-- Title Field -->
        <div>
            <label for="title" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Title <span class="text-rose-500">*</span>
            </label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Enter an engaging title..."
                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-slate-900 placeholder-slate-400 text-lg font-medium shadow-sm @error('title') border-rose-500 focus:ring-rose-500/50 focus:border-rose-500 bg-rose-50/30 @enderror"
                required
            >
            @error('title')
                <p class="mt-2.5 text-sm font-medium text-rose-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Content Field -->
        <div>
            <label for="content" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Content <span class="text-rose-500">*</span>
            </label>
            <textarea
                id="content"
                name="content"
                rows="14"
                placeholder="Write your post content here..."
                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-slate-900 placeholder-slate-400 font-mono text-sm leading-relaxed shadow-sm @error('content') border-rose-500 focus:ring-rose-500/50 focus:border-rose-500 bg-rose-50/30 @enderror"
                required
            >{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-2.5 text-sm font-medium text-rose-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Status Field -->
        <div>
            <label for="status" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Status <span class="text-rose-500">*</span>
            </label>
            <select
                id="status"
                name="status"
                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-slate-900 font-medium shadow-sm cursor-pointer @error('status') border-rose-500 focus:ring-rose-500/50 focus:border-rose-500 bg-rose-50/30 @enderror"
                required
            >
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft - Save for later</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published - Make it live</option>
            </select>
            @error('status')
                <p class="mt-2.5 text-sm font-medium text-rose-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4 pt-8 border-t border-slate-100">
            <button
                type="submit"
                class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-xl hover:from-indigo-500 hover:to-violet-500 font-semibold transition-all shadow-md hover:shadow-xl hover:-translate-y-0.5 flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Create Post
            </button>
            <a
                href="{{ route('admin.posts.index') }}"
                class="px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 hover:text-slate-900 font-semibold transition-all hover:-translate-y-0.5"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
