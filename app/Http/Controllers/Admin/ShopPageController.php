<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCategory;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopPageController extends Controller
{
    public function edit()
    {
        $categories = ShopCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.shop.edit', compact('categories'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'shop_hero_visible' => ['nullable', 'boolean'],
            'shop_hero_eyebrow' => ['nullable', 'string', 'max:255'],
            'shop_hero_title' => ['nullable', 'string', 'max:255'],
            'shop_hero_description' => ['nullable', 'string'],

            'shop_grid_visible' => ['nullable', 'boolean'],

            'shop_cta_visible' => ['nullable', 'boolean'],
            'shop_cta_eyebrow' => ['nullable', 'string', 'max:255'],
            'shop_cta_title' => ['nullable', 'string', 'max:255'],
            'shop_cta_description' => ['nullable', 'string'],
            'shop_cta_button_text' => ['nullable', 'string', 'max:255'],
            'shop_cta_button_url' => ['nullable', 'string', 'max:500'],
            'shop_cta_link_type' => ['nullable', 'string', 'max:50'],
        ]);

        $settings = [
            'shop_hero_visible' => $request->boolean('shop_hero_visible') ? '1' : '0',
            'shop_hero_eyebrow' => $request->input('shop_hero_eyebrow', '🛍 SHOP'),
            'shop_hero_title' => $request->input('shop_hero_title', 'দোকান'),
            'shop_hero_description' => $request->input('shop_hero_description', 'Products are being added. For any product enquiry please call or WhatsApp us.'),
            'shop_grid_visible' => $request->boolean('shop_grid_visible') ? '1' : '0',
            'shop_cta_visible' => $request->boolean('shop_cta_visible') ? '1' : '0',
            'shop_cta_eyebrow' => $request->input('shop_cta_eyebrow', 'PERSONALIZED RECOMMENDATION'),
            'shop_cta_title' => $request->input('shop_cta_title', 'Need Guidance on Gemstones or Remedies?'),
            'shop_cta_description' => $request->input('shop_cta_description', 'Gemstones and Yantras work best when prescribed strictly according to your horoscope\'s planetary periods (Dasha) and planetary strength.'),
            'shop_cta_button_text' => $request->input('shop_cta_button_text', 'BOOK HOROSCOPE ANALYSIS'),
            'shop_cta_button_url' => $request->input('shop_cta_button_url', '/book-consultation'),
            'shop_cta_link_type' => $request->input('shop_cta_link_type', 'internal'),
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value, 'shop');
        }

        return redirect()->route('admin.shop.edit')->with('status', 'Shop Page settings updated successfully.');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'url' => ['nullable', 'string', 'max:500'],
            'link_type' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        ShopCategory::create($validated);

        return redirect()->route('admin.shop.edit')->with('status', 'Category "' . $validated['name'] . '" created successfully.');
    }

    public function updateCategory(Request $request, ShopCategory $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'url' => ['nullable', 'string', 'max:500'],
            'link_type' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $category->update($validated);

        return redirect()->route('admin.shop.edit')->with('status', 'Category "' . $category->name . '" updated successfully.');
    }

    public function destroyCategory(ShopCategory $category)
    {
        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.shop.edit')->with('status', 'Category "' . $name . '" deleted successfully.');
    }
}
