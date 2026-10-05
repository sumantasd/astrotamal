<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $cmsPage = \App\Models\CmsPage::where('slug', 'services')->first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('services.index', compact('services', 'cmsPage'));
    }

    public function show($slug)
    {
        $slugMap = [
            'birth-chart-analysis' => 'birth-chart',
            'transit-timing-analysis' => 'transit-timing',
            'career-job-guidance' => 'career-guidance',
            'life-direction-guidance' => 'life-direction',
            'learn-astrology' => 'astrology-learning',
        ];

        if (isset($slugMap[$slug])) {
            $targetSlug = $slugMap[$slug];
            $service = Service::where('slug', $targetSlug)->first();
        } else {
            $service = Service::where('slug', $slug)->first();
        }

        if (!$service) {
            $service = Service::where('slug', 'like', '%' . explode('-', $slug)[0] . '%')->firstOrFail();
        }

        if (!$service->is_active && !auth()->check()) {
            abort(404);
        }

        $otherServices = Service::where('id', '!=', $service->id)->where('is_active', true)->orderBy('sort_order')->take(3)->get();

        $viewName = 'services.' . $service->slug;
        if (view()->exists($viewName)) {
            return view($viewName, compact('service', 'otherServices'));
        }

        return view('services.show', compact('service', 'otherServices'));
    }
}
