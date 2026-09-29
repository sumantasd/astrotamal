<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function header()
    {
        return view('admin.settings.header');
    }

    public function footer()
    {
        return view('admin.settings.footer');
    }

    public function general()
    {
        return view('admin.settings.general');
    }

    public function seo()
    {
        return view('admin.settings.seo');
    }

    public function update(Request $request)
    {
        $group = $request->input('group', 'general');
        $settings = $request->except(['_token', '_method', 'group']);

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, is_array($value) ? json_encode($value) : $value, $group);
        }

        return back()->with('status', 'Website settings saved successfully.');
    }
}
