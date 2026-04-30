@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Link -->
    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium mb-10 group bg-indigo-50/50 hover:bg-indigo-50 px-4 py-2 rounded-xl transition-all">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to articles
    </a>

    <!-- Post Header -->
    <article class="bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-10 md:p-16 relative overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-indigo-50 to-transparent rounded-bl-full -z-10 opacity-60"></div>
        
        <!-- Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 mb-8 leading-[1.1] tracking-tight">{{ $post->title }}</h1>

        <!-- Post Meta -->
        <div class="flex flex-wrap items-center gap-6 md:gap-10 text-slate-600 mb-12 pb-12 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-violet-500 to-indigo-500 flex items-center justify-center text-white font-bold text-lg shadow-sm ring-4 ring-indigo-50">
                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-xs font-bold text-indigo-500 uppercase tracking-widest mb-0.5">Author</p>
                    <p class="font-semibold text-slate-900 text-lg">{{ $post->user->name ?? 'Unknown' }}</p>
                </div>
            </div>
            <div class="w-px h-10 bg-slate-200 hidden md:block"></div>
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-slate-50 rounded-xl text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Published</p>
                    <p class="font-semibold text-slate-900">{{ $post->published_at->format('M d, Y') }}</p>
                </div>
            </div>
            @if($post->status === 'draft')
                <div class="w-px h-10 bg-slate-200 hidden md:block"></div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-50 border border-amber-200/60 text-amber-600 rounded-xl font-bold text-sm tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        DRAFT
                    </span>
                </div>
            @endif
        </div>

        <!-- Post Content -->
        <div class="prose prose-lg md:prose-xl max-w-none prose-slate prose-headings:font-bold prose-headings:tracking-tight prose-a:text-indigo-600 hover:prose-a:text-indigo-500 prose-img:rounded-2xl prose-img:shadow-lg leading-relaxed font-light">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>
</div>
@endsection
