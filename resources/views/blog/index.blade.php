@extends('layouts.app')

@section('title', 'Discover Great Content')

@section('content')
<div class="space-y-16">
    <!-- Hero Section -->
    <div class="text-center max-w-4xl mx-auto space-y-8 pt-10 pb-8">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-sm font-semibold mb-2 shadow-sm">
            <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
            Latest Insights
        </div>
        <h1 class="text-5xl md:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900 tracking-tight leading-tight">
            Explore ideas that <br/> matter to you.
        </h1>
        <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-light">
            Dive into our collection of expert articles, tutorials, and stories designed to inspire and educate.
        </p>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto w-full pt-8 relative z-10">
            <form method="GET" action="{{ route('blog.index') }}" class="relative group flex items-center">
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <svg class="w-6 h-6 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input
                    type="text"
                    name="search"
                    placeholder="Search for articles, topics, or authors..."
                    value="{{ request('search') }}"
                    class="block w-full pl-16 pr-36 py-5 bg-white/80 backdrop-blur-md border-2 border-white rounded-2xl text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-0 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] focus:bg-white text-lg font-medium"
                >
                <button type="submit" class="absolute right-2.5 top-2.5 bottom-2.5 px-8 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-xl hover:from-indigo-500 hover:to-violet-500 font-semibold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- Posts Grid -->
    @if($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
            @foreach($posts as $post)
                <article class="group bg-white rounded-3xl border border-slate-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] hover:shadow-2xl hover:shadow-indigo-100/50 hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col">
                    <div class="h-56 bg-gradient-to-br from-indigo-50 to-violet-50 relative overflow-hidden flex items-center justify-center">
                        <!-- Abstract pattern instead of real image -->
                        <div class="absolute inset-0 opacity-30 bg-[radial-gradient(circle_at_1px_1px,#6366f1_1px,transparent_0)] [background-size:24px_24px]"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-white/60 to-transparent"></div>
                        <svg class="w-20 h-20 text-indigo-200/80 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3L22 4"/></svg>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 mb-5">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold uppercase tracking-wider rounded-lg">
                                Article
                            </span>
                            <span class="text-sm text-slate-500 flex items-center gap-1.5 font-medium">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $post->published_at->format('M d, Y') }}
                            </span>
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="block mb-4">
                            <h2 class="text-2xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">
                                {{ $post->title }}
                            </h2>
                        </a>

                        <p class="text-slate-600 line-clamp-3 mb-8 leading-relaxed flex-1 font-light text-lg">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-violet-500 to-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-white">
                                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="font-semibold text-slate-900">{{ $post->user->name ?? 'Author' }}</span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-20 flex justify-center relative z-10">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-slate-100 p-2 inline-block">
                {{ $posts->links() }}
            </div>
        </div>
    @else
        <div class="text-center py-32 px-6 rounded-3xl bg-white/60 backdrop-blur-md border border-white shadow-xl max-w-2xl mx-auto relative z-10">
            <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-8 shadow-sm border border-slate-100">
                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">No posts found</h3>
            <p class="text-slate-500 text-xl font-light">We couldn't find anything matching your search. Try adjusting your keywords.</p>
        </div>
    @endif
</div>
@endsection
