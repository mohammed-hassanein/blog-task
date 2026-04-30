@extends('layouts.app')

@section('title', 'Admin - ' . $post->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Link -->
    <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium mb-8 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Posts
    </a>

    <!-- Post Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-10">
        <!-- Header -->
        <div class="mb-8 pb-8 border-b border-slate-200">
            <div class="flex items-start justify-between gap-4 mb-4">
                <h1 class="text-4xl font-bold text-slate-900 leading-tight">{{ $post->title }}</h1>
                <!-- Status Badge -->
                @if($post->status === 'published')
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold flex-shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Published
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-semibold flex-shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                        Draft
                    </span>
                @endif
            </div>
        </div>

        <!-- Post Meta -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 pb-8 border-b border-slate-200">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1">Author</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr($post->user->name ?? 'A', 0, 1) }}
                    </div>
                    <p class="font-semibold text-slate-900">{{ $post->user->name ?? 'Unknown' }}</p>
                </div>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-2">Created</p>
                <p class="font-semibold text-slate-900">{{ $post->created_at->format('M d, Y') }}</p>
                <p class="text-sm text-slate-600">{{ $post->created_at->format('H:i') }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-2">Published</p>
                @if($post->published_at)
                    <p class="font-semibold text-slate-900">{{ $post->published_at->format('M d, Y') }}</p>
                    <p class="text-sm text-slate-600">{{ $post->published_at->format('H:i') }}</p>
                @else
                    <p class="text-sm text-slate-600">Not yet published</p>
                @endif
            </div>
        </div>

        <!-- Slug -->
        <div class="mb-8 pb-8 border-b border-slate-200">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-2">Slug</p>
            <p class="font-mono text-slate-900 text-sm bg-slate-50 px-3 py-2 rounded-lg break-all">{{ $post->slug }}</p>
        </div>

        <!-- Content -->
        <div class="mb-10">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Content</h3>
            <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed bg-slate-50 p-6 rounded-xl space-y-4">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap gap-3 pt-8 border-t border-slate-200">
            <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-all hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>

            <form method="POST" action="{{ route('admin.posts.toggleStatus', $post) }}" style="display: inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-700 font-medium transition-all hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    {{ $post->status === 'published' ? 'Unpublish' : 'Publish' }}
                </button>
            </form>

            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline;" onsubmit="return confirm('Are you sure? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-all hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete
                </button>
            </form>

            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 text-slate-900 rounded-lg hover:bg-slate-200 font-medium transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </a>
        </div>
    </div>
</div>
@endsection
