<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use App\Models\HomeVideo;
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

        $items = $query->orderBy('sort_order', 'asc')->latest('updated_at')->paginate(12)->withQueryString();

        return view('admin.media.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'tag' => 'nullable|string|max:255',
            'type' => 'required|in:image,video,youtube',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:51200',
            'thumbnail_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'thumbnail_url' => 'nullable|string|max:1000',
            'url' => 'nullable|url|max:1000',
            'is_published' => 'nullable|boolean',
            'publish_gallery' => 'nullable|boolean',
            'publish_videos' => 'nullable|boolean',
            'show_on_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $filePath = null;
        if ($request->hasFile('media_file')) {
            $filePath = $request->file('media_file')->store('media', 'public');
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('thumbnails', 'public');
            $thumbnailPath = '/storage/' . $path;
        } elseif (!empty($validated['thumbnail_url'])) {
            $thumbnailPath = $validated['thumbnail_url'];
        } elseif ($validated['type'] === 'youtube' && !empty($validated['url'])) {
            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $validated['url'], $matches);
            if (isset($matches[1])) {
                $thumbnailPath = 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
            }
        }

        $isPublished = $request->boolean('is_published', true);
        $type = $validated['type'];

        $publishGallery = $type === 'image' ? $request->boolean('publish_gallery', true) : false;
        $publishVideos = in_array($type, ['youtube', 'video']) ? $request->boolean('publish_videos', true) : false;
        $showOnHome = in_array($type, ['youtube', 'video']) ? $request->boolean('show_on_home', false) : false;

        $media = MediaItem::create([
            'title' => $validated['title'],
            'caption' => $validated['caption'] ?? null,
            'tag' => $validated['tag'] ?? null,
            'type' => $type,
            'file_path' => $filePath,
            'url' => $validated['url'] ?? null,
            'thumbnail' => $thumbnailPath,
            'is_published' => $isPublished,
            'publish_gallery' => $publishGallery,
            'publish_videos' => $publishVideos,
            'show_on_home' => $showOnHome,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        $this->syncHomeVideo($media);

        return redirect()->route('admin.media.index')
            ->with('status', 'Media item created successfully.');
    }

    public function update(Request $request, MediaItem $medium)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'tag' => 'nullable|string|max:255',
            'type' => 'required|in:image,video,youtube',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:51200',
            'thumbnail_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'thumbnail_url' => 'nullable|string|max:1000',
            'url' => 'nullable|url|max:1000',
            'is_published' => 'nullable|boolean',
            'publish_gallery' => 'nullable|boolean',
            'publish_videos' => 'nullable|boolean',
            'show_on_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('media_file')) {
            if ($medium->file_path && Storage::disk('public')->exists($medium->file_path)) {
                Storage::disk('public')->delete($medium->file_path);
            }
            $validated['file_path'] = $request->file('media_file')->store('media', 'public');
        }

        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('thumbnails', 'public');
            $validated['thumbnail'] = '/storage/' . $path;
        } elseif ($request->filled('thumbnail_url')) {
            $validated['thumbnail'] = $validated['thumbnail_url'];
        }

        $type = $validated['type'];
        $validated['is_published'] = $request->boolean('is_published');
        $validated['publish_gallery'] = $type === 'image' ? $request->boolean('publish_gallery') : false;
        $validated['publish_videos'] = in_array($type, ['youtube', 'video']) ? $request->boolean('publish_videos') : false;
        $validated['show_on_home'] = in_array($type, ['youtube', 'video']) ? $request->boolean('show_on_home') : false;
        $validated['sort_order'] = $validated['sort_order'] ?? $medium->sort_order;

        $medium->update($validated);

        $this->syncHomeVideo($medium);

        return redirect()->route('admin.media.index')
            ->with('status', 'Media item updated successfully.');
    }

    public function destroy(MediaItem $medium)
    {
        if ($medium->file_path && Storage::disk('public')->exists($medium->file_path)) {
            Storage::disk('public')->delete($medium->file_path);
        }

        if (in_array($medium->type, ['youtube', 'video'])) {
            $videoUrl = $medium->video_url;
            HomeVideo::where('video_url', $videoUrl)->delete();
        }

        $medium->delete();

        return redirect()->route('admin.media.index')
            ->with('status', 'Media item deleted successfully.');
    }

    /**
     * Helper to keep legacy HomeVideo model in 100% sync if used anywhere.
     */
    protected function syncHomeVideo(MediaItem $media): void
    {
        if (in_array($media->type, ['youtube', 'video'])) {
            $videoUrl = $media->video_url;
            $thumbnail = $media->thumbnail;

            if ($media->show_on_home && $media->is_published) {
                HomeVideo::updateOrCreate(
                    ['video_url' => $videoUrl],
                    [
                        'title' => $media->title,
                        'tag' => $media->tag,
                        'thumbnail' => $thumbnail,
                        'display_order' => $media->sort_order,
                        'is_active' => true,
                    ]
                );
            } else {
                HomeVideo::where('video_url', $videoUrl)->delete();
            }
        }
    }
}
