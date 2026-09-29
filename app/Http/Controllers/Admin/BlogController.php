<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $categories = ['Planets', 'Relationship', 'Career', 'Vastu', 'Numerology', 'Spirituality'];

        return view('admin.blogs.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = ['Planets', 'Relationship', 'Career', 'Vastu', 'Numerology', 'Spirituality'];
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'summary' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'author_name' => 'nullable|string|max:100',
            'read_time' => 'nullable|string|max:50',
            'image_file' => 'nullable|image|max:5120',
            'is_featured' => 'boolean',
        ]);

        $slug = Str::slug($validated['title']);
        $count = BlogPost::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('blog', 'public');
        }

        BlogPost::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'summary' => $validated['summary'] ?? null,
            'content' => $validated['content'],
            'image' => $imagePath,
            'author_name' => $validated['author_name'] ?? 'Tamal Chakraborty',
            'read_time' => $validated['read_time'] ?? '5 min read',
            'published_at' => now(),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('status', 'Blog article published successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = ['Planets', 'Relationship', 'Career', 'Vastu', 'Numerology', 'Spirituality'];
        return view('admin.blogs.edit', compact('blogPost', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'summary' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'author_name' => 'nullable|string|max:100',
            'read_time' => 'nullable|string|max:50',
            'image_file' => 'nullable|image|max:5120',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            if ($blogPost->image && Storage::disk('public')->exists($blogPost->image)) {
                Storage::disk('public')->delete($blogPost->image);
            }
            $validated['image'] = $request->file('image_file')->store('blog', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $blogPost->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('status', 'Blog article updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->image && Storage::disk('public')->exists($blogPost->image)) {
            Storage::disk('public')->delete($blogPost->image);
        }

        $blogPost->delete();

        return redirect()->route('admin.blogs.index')
            ->with('status', 'Blog article deleted successfully.');
    }
}
