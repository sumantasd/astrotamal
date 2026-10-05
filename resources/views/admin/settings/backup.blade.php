@extends('admin.layouts.app')

@section('title', 'Database Backup & Restore')
@section('header_title', 'Database Backup & Restore')
@section('header_subtitle', 'Create, download and restore complete SQL database backups.')

@section('content')
<div x-data="{ 
    restoreModalOpen: false, 
    restoreUrl: '', 
    restoreFilename: '',
    confirmRestore(url, name) {
        this.restoreUrl = url;
        this.restoreFilename = name;
        this.restoreModalOpen = true;
    }
}" class="space-y-8 max-w-5xl">

    @if (session('status'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 bg-red-100 border border-red-300 text-red-800 text-xs font-bold rounded-2xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Action Bar: Create SQL Backup & Upload SQL Restore -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Create New Backup Card -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs flex flex-col justify-between space-y-4">
            <div>
                <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-1">DATABASE BACKUP</h3>
                <p class="text-xs text-[#81766D]">Create a complete SQL backup of the AstroTamal database.</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.backup.create') }}">
                @csrf
                <button type="submit" class="w-full py-3 px-5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-xl shadow-xs transition-colors">
                    + CREATE SQL BACKUP
                </button>
            </form>
        </div>

        <!-- Upload & Restore Backup Card -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs flex flex-col justify-between space-y-4">
            <div>
                <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-1">RESTORE DATABASE</h3>
                <p class="text-xs text-[#81766D]">Upload a previously created AstroTamal SQL backup to restore the database.</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.backup.upload-restore') }}" enctype="multipart/form-data" class="flex items-center space-x-2" onsubmit="return confirm('Upload and restore this SQL backup?')">
                @csrf
                <input type="file" name="backup_file" accept=".sql" required class="flex-1 text-xs text-[#81766D] file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#EDE3D4] file:text-[#541F1D] hover:file:bg-[#D8C6A8]">
                <button type="submit" class="py-2.5 px-4 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-xl shadow-xs whitespace-nowrap">
                    RESTORE DATABASE
                </button>
            </form>
        </div>

    </div>

    <!-- Backups List Table -->
    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 shadow-xs">
        <h3 class="font-serif-luxury text-base font-bold text-[#541F1D] mb-4">Backup Archives History</h3>

        @if ($backups->isEmpty())
            <div class="py-8 text-center text-xs text-[#81766D]">No SQL backups created yet. Click "+ CREATE SQL BACKUP" above to generate your first database dump.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#D8C6A8]/60 text-[11px] font-bold uppercase tracking-wider text-[#81766D]">
                            <th class="pb-3 px-3">Backup File Name</th>
                            <th class="pb-3 px-3">Type</th>
                            <th class="pb-3 px-3">File Size</th>
                            <th class="pb-3 px-3">Created At</th>
                            <th class="pb-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/30 text-xs text-[#29211F]">
                        @foreach ($backups as $b)
                            <tr class="hover:bg-[#EDE3D4]/30 transition-colors">
                                <td class="py-3.5 px-3 font-mono font-bold text-[#541F1D]">
                                    {{ $b->filename }}
                                </td>
                                <td class="py-3.5 px-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $b->type === 'pre_restore' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                        {{ $b->type === 'pre_restore' ? 'PRE-RESTORE SAFETY' : 'MANUAL SQL BACKUP' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 font-medium">
                                    {{ $b->formatted_size }}
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap text-[11px] text-[#81766D]">
                                    {{ $b->created_at ? $b->created_at->format('d M Y, h:i A') : '' }}
                                </td>
                                <td class="py-3.5 px-3 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.settings.backup.download', $b) }}" class="px-3 py-1 text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] rounded-lg border border-[#D8C6A8]">
                                        Download
                                    </a>

                                    <button type="button" 
                                            @click="confirmRestore('{{ route('admin.settings.backup.restore', $b) }}', '{{ e($b->filename) }}')"
                                            class="px-3 py-1 text-xs font-bold text-amber-900 bg-amber-100 hover:bg-amber-200 rounded-lg">
                                        Restore
                                    </button>

                                    <form method="POST" action="{{ route('admin.settings.backup.destroy', $b) }}" class="inline-block" onsubmit="return confirm('Delete this SQL backup file permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs font-bold text-red-800 bg-red-100 hover:bg-red-200 rounded-lg">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $backups->links() }}
            </div>
        @endif
    </div>

    <!-- Restore Confirmation Modal -->
    <div x-show="restoreModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="restoreModalOpen = false" class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-5">
            <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                <h3 class="font-serif-luxury text-base font-bold text-amber-900 flex items-center space-x-2">
                    <span>⚠️</span>
                    <span>Confirm Database Restore</span>
                </h3>
                <button type="button" @click="restoreModalOpen = false" class="text-[#81766D] hover:text-[#541F1D] font-bold text-lg">✕</button>
            </div>

            <div class="text-xs text-[#29211F] space-y-3 leading-relaxed">
                <p class="font-bold text-red-800">Warning: This action will replace your current website database with data from the selected SQL backup file:</p>
                <div class="p-3 bg-[#EDE3D4] font-mono text-xs font-bold text-[#541F1D] rounded-xl text-center" x-text="restoreFilename"></div>
                <p class="text-[#81766D]">An automatic pre-restore safety backup of your CURRENT live database will be created before restoring.</p>
            </div>

            <form :action="restoreUrl" method="POST" class="pt-3 flex items-center justify-end space-x-3 border-t border-[#D8C6A8]/60">
                @csrf
                <button type="button" @click="restoreModalOpen = false" class="px-4 py-2 text-xs font-bold text-[#81766D] hover:text-[#29211F]">Cancel</button>
                <button type="submit" class="px-5 py-2 text-xs font-bold uppercase tracking-wider text-white bg-red-800 hover:bg-red-900 rounded-xl shadow-md">
                    Yes, Restore Now
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
