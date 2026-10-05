<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('media_items', function (Blueprint $table) {
            if (!Schema::hasColumn('media_items', 'publish_gallery')) {
                $table->boolean('publish_gallery')->default(false)->after('is_published');
            }
            if (!Schema::hasColumn('media_items', 'publish_videos')) {
                $table->boolean('publish_videos')->default(false)->after('publish_gallery');
            }
            if (!Schema::hasColumn('media_items', 'show_on_home')) {
                $table->boolean('show_on_home')->default(false)->after('publish_videos');
            }
            if (!Schema::hasColumn('media_items', 'tag')) {
                $table->string('tag')->nullable()->after('caption');
            }
            if (!Schema::hasColumn('media_items', 'thumbnail')) {
                $table->string('thumbnail')->nullable()->after('url');
            }
        });

        // Populate defaults for existing records safely
        DB::table('media_items')->where('type', 'image')->update([
            'publish_gallery' => DB::raw('is_published'),
        ]);

        DB::table('media_items')->whereIn('type', ['video', 'youtube'])->update([
            'publish_videos' => DB::raw('is_published'),
            'show_on_home' => DB::raw('is_published'),
        ]);

        // Sync existing home_videos records into media_items if any exist
        if (Schema::hasTable('home_videos')) {
            $homeVideos = DB::table('home_videos')->get();
            foreach ($homeVideos as $hv) {
                $exists = DB::table('media_items')
                    ->where('url', $hv->video_url)
                    ->orWhere('title', $hv->title)
                    ->exists();

                if (!$exists) {
                    DB::table('media_items')->insert([
                        'title' => $hv->title,
                        'tag' => $hv->tag,
                        'type' => 'youtube',
                        'url' => $hv->video_url,
                        'thumbnail' => $hv->thumbnail,
                        'is_published' => $hv->is_active,
                        'publish_gallery' => false,
                        'publish_videos' => $hv->is_active,
                        'show_on_home' => $hv->is_active,
                        'sort_order' => $hv->display_order,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_items', function (Blueprint $table) {
            $columns = ['publish_gallery', 'publish_videos', 'show_on_home', 'tag', 'thumbnail'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('media_items', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
