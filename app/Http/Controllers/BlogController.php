<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $posts = $query->latest()->paginate(6);
        $categories = ['Planets', 'Relationship', 'Career', 'Vastu', 'Numerology', 'Spirituality'];

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $recentPosts = BlogPost::where('id', '!=', $post->id)->latest()->take(3)->get();
        return view('blog.show', compact('post', 'recentPosts'));
    }
}
