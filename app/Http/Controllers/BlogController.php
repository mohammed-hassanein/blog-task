<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->search($request->input('search'));
            })
            ->latest('published_at')
            ->paginate(10)
            ->withQueryString(); 

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->status !== Post::STATUS_PUBLISHED) {
            abort(404);
        }

        return view('blog.show', compact('post'));
    }
}
