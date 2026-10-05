<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SidebarMenuService;
use Illuminate\Http\Request;

class SidebarSettingsController extends Controller
{
    public function index()
    {
        $definitions = SidebarMenuService::getMenuDefinitions();
        $currentVisibility = SidebarMenuService::getVisibility();

        return view('admin.settings.sidebar', compact('definitions', 'currentVisibility'));
    }

    public function update(Request $request)
    {
        $groupInputs = $request->input('groups', []);
        $itemInputs = $request->input('items', []);

        $definitions = SidebarMenuService::getMenuDefinitions();
        $formatted = [
            'groups' => [],
            'items' => [],
        ];

        foreach ($definitions as $groupKey => $groupData) {
            $formatted['groups'][$groupKey] = isset($groupInputs[$groupKey]) && (bool)$groupInputs[$groupKey];

            foreach ($groupData['items'] as $itemKey => $itemLabel) {
                $formatted['items'][$groupKey][$itemKey] = isset($itemInputs[$groupKey][$itemKey]) && (bool)$itemInputs[$groupKey][$itemKey];
            }
        }

        SidebarMenuService::setVisibility($formatted);

        return redirect()->back()->with('status', 'Sidebar menu visibility settings saved successfully.');
    }
}
