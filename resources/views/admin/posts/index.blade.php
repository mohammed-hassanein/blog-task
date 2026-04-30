@extends('layouts.app')

@section('title', 'Admin - Manage Posts')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto relative z-10">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 pb-8 border-b border-slate-200/60">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900 mb-2 tracking-tight">Posts Dashboard</h1>
            <p class="text-slate-500 font-medium text-lg">Manage and publish your blog content.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="px-6 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-xl hover:from-indigo-500 hover:to-violet-500 font-semibold transition-all shadow-md hover:shadow-xl hover:-translate-y-0.5 flex items-center gap-2 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Create New Post
        </a>
    </div>

    <!-- Actions Bar -->
    <div class="flex items-center justify-between gap-4">
        <div class="max-w-md w-full">
            <form method="GET" action="{{ route('admin.posts.index') }}" class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input
                    type="text"
                    name="search"
                    placeholder="Search posts..."
                    value="{{ request('search') }}"
                    class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all shadow-sm text-slate-900 font-medium placeholder-slate-400"
                >
            </form>
        </div>
    </div>

    <!-- Posts Table -->
    @if($posts->count())
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap lg:whitespace-normal">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100">
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Title & Slug</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Published</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($posts as $post)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <p class="font-bold text-slate-900 text-base mb-1 group-hover:text-indigo-600 transition-colors">{{ $post->title }}</p>
                                    <p class="text-sm text-slate-400 font-medium flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        {{ $post->slug }}
                                    </p>
                                </td>
                                <td class="px-8 py-5">
                                    @if($post->status === 'published')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200/60 rounded-lg text-sm font-bold tracking-wide">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 border border-amber-200/60 rounded-lg text-sm font-bold tracking-wide">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-600">
                                    {{ $post->published_at?->format('M d, Y') ?? '—' }}
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.posts.show', $post) }}" class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="p-2.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.posts.toggleStatus', $post) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all" title="{{ $post->status === 'published' ? 'Move to Draft' : 'Publish' }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-2 inline-block">
                {{ $posts->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-20 text-center">
            <div class="w-20 h-20 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <p class="text-slate-900 font-bold text-2xl mb-2 tracking-tight">No posts found</p>
            <p class="text-slate-500 text-lg mb-8 font-medium">Get started by creating your very first post.</p>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-xl hover:from-indigo-500 hover:to-violet-500 font-semibold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Create your first post
            </a>
        </div>
    @endif
</div>
@endsection
