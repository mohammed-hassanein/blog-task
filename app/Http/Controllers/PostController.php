<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest()
            ->when($request->filled('search'), fn($q) => $q->search($request->search))
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    public function toggleStatus(Post $post)
    {
        $post->update([
            'status' => $post->status === Post::STATUS_PUBLISHED
                ? Post::STATUS_DRAFT
                : Post::STATUS_PUBLISHED,
            'published_at' => $post->status === Post::STATUS_DRAFT
                ? now()
                : null,
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post status updated.');
    }
}
