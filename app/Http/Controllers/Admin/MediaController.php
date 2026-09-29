<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaItem::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $items = $query->orderBy('sort_order')->latest('updated_at')->paginate(12)->withQueryString();

        return view('admin.media.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'type' => 'required|in:image,video,youtube',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:20480',
            'url' => 'nullable|url|max:1000',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $filePath = null;
        if ($request->hasFile('media_file')) {
            $filePath = $request->file('media_file')->store('media', 'public');
        }

        MediaItem::create([
            'title' => $validated['title'],
            'caption' => $validated['caption'] ?? null,
            'type' => $validated['type'],
            'file_path' => $filePath,
            'url' => $validated['url'] ?? null,
            'is_published' => $request->has('is_published'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.media.index')
            ->with('status', 'Media item created successfully.');
    }

    public function update(Request $request, MediaItem $mediaItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'type' => 'required|in:image,video,youtube',
            'url' => 'nullable|url|max:1000',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('media_file')) {
            if ($mediaItem->file_path && Storage::disk('public')->exists($mediaItem->file_path)) {
                Storage::disk('public')->delete($mediaItem->file_path);
            }
            $validated['file_path'] = $request->file('media_file')->store('media', 'public');
        }

        $validated['is_published'] = $request->has('is_published');
        $mediaItem->update($validated);

        return redirect()->route('admin.media.index')
            ->with('status', 'Media item updated successfully.');
    }

    public function destroy(MediaItem $mediaItem)
    {
        if ($mediaItem->file_path && Storage::disk('public')->exists($mediaItem->file_path)) {
            Storage::disk('public')->delete($mediaItem->file_path);
        }

        $mediaItem->delete();

        return redirect()->route('admin.media.index')
            ->with('status', 'Media item deleted successfully.');
    }
}
