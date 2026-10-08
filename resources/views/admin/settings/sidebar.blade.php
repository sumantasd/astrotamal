@extends('admin.layouts.app')

@section('title', 'Sidebar Menu Visibility')
@section('header_title', 'Sidebar Menu Visibility Settings')
@section('header_subtitle', 'Control which sidebar navigation menus and submenus are visible in the Admin Panel')

@section('content')
<div class="space-y-8 max-w-5xl">

    @if (session('status'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.sidebar.update') }}" class="space-y-6">
        @csrf

        <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-3xl p-6 sm:p-7 shadow-xs">
            <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-4 mb-6">
                <div>
                    <h3 class="font-serif-luxury text-base font-bold text-[#0B3D2E]">Sidebar Navigation Toggles</h3>
                    <p class="text-xs text-[#60736B]">Toggle visibility ON/OFF. Note: Disabling visibility hides the link from sidebar without revoking underlying access permissions.</p>
                </div>

                <button type="submit" class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-xl shadow-xs">
                    Save Changes
                </button>
            </div>

            <div class="space-y-6">
                @foreach ($definitions as $groupKey => $group)
                    @php
                        $groupActive = \App\Services\SidebarMenuService::isGroupVisible($groupKey);
                    @endphp
                    <div class="bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-2xl p-5 space-y-4">
                        
                        <!-- Parent Group Header -->
                        <div class="flex items-center justify-between border-b border-[#C8D8CF]/60 pb-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="groups[{{ $groupKey }}]" value="1" {{ $groupActive ? 'checked' : '' }} class="w-4 h-4 accent-[#0B3D2E] rounded">
                                <span class="font-serif-luxury text-sm font-bold text-[#0B3D2E] uppercase tracking-wider">{{ $group['label'] }}</span>
                            </label>

                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded {{ $groupActive ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                {{ $groupActive ? 'GROUP ACTIVE' : 'GROUP HIDDEN' }}
                            </span>
                        </div>

                        <!-- Child Items -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 pl-2">
                            @foreach ($group['items'] as $itemKey => $itemLabel)
                                @php
                                    $itemActive = \App\Services\SidebarMenuService::isItemVisible($groupKey, $itemKey);
                                @endphp
                                <label class="flex items-center space-x-2.5 p-2 rounded-xl bg-[#FFFFFF] border border-[#C8D8CF]/70 hover:border-[#C49A45] cursor-pointer text-xs">
                                    <input type="checkbox" name="items[{{ $groupKey }}][{{ $itemKey }}]" value="1" {{ $itemActive ? 'checked' : '' }} class="w-3.5 h-3.5 accent-[#0B3D2E] rounded">
                                    <span class="font-medium text-[#17211D]">{{ $itemLabel }}</span>
                                </label>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="pt-6 border-t border-[#C8D8CF]/60 text-right">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] rounded-full shadow-md">
                    Save Sidebar Menu Settings
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
