<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BackupHistory;
use App\Services\BackupRestoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        $backups = BackupHistory::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.settings.backup', compact('backups'));
    }

    public function create()
    {
        try {
            $backup = BackupRestoreService::createBackup('manual');
            return redirect()->back()->with('status', "Database SQL backup '{$backup->filename}' created successfully.");
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', "Failed to create SQL backup: " . $e->getMessage());
        }
    }

    public function download(BackupHistory $backup)
    {
        $fullPath = storage_path('app/' . $backup->path);
        if (!File::exists($fullPath)) {
            $fullPath = storage_path('app/backups/' . $backup->filename);
        }

        if (!File::exists($fullPath)) {
            return redirect()->back()->with('error', 'Backup file not found on disk.');
        }

        return response()->download($fullPath, $backup->filename, [
            'Content-Type' => 'application/sql',
        ]);
    }

    public function restore(BackupHistory $backup)
    {
        $fullPath = storage_path('app/' . $backup->path);
        if (!File::exists($fullPath)) {
            $fullPath = storage_path('app/backups/' . $backup->filename);
        }

        if (!File::exists($fullPath)) {
            return redirect()->back()->with('error', 'Backup file not found on disk.');
        }

        try {
            BackupRestoreService::restoreBackup($fullPath);
            return redirect()->back()->with('status', "Database successfully restored from backup '{$backup->filename}'. An automatic pre-restore safety backup was created.");
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', "Restore failed: " . $e->getMessage());
        }
    }

    public function uploadAndRestore(Request $request)
    {
        $request->validate([
            'backup_file' => ['required', 'file', 'max:51200'], // max 50MB
        ]);

        $file = $request->file('backup_file');
        $extension = strtolower($file->getClientOriginalExtension());
        if ($extension !== 'sql') {
            return redirect()->back()->with('error', 'Invalid file type: Uploaded file must have a .sql extension.');
        }

        $filename = 'uploaded_' . time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
        $targetPath = storage_path('app/backups/' . $filename);

        $file->move(storage_path('app/backups'), $filename);

        $validation = BackupRestoreService::validateBackupSql($targetPath);
        if (!$validation['valid']) {
            File::delete($targetPath);
            return redirect()->back()->with('error', 'Uploaded SQL file rejected: ' . $validation['error']);
        }

        try {
            BackupRestoreService::restoreBackup($targetPath);
            return redirect()->back()->with('status', 'Database successfully restored from uploaded SQL backup. An automatic pre-restore safety backup was created.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Restore failed: ' . $e->getMessage());
        }
    }

    public function destroy(BackupHistory $backup)
    {
        $fullPath = storage_path('app/' . $backup->path);
        if (!File::exists($fullPath)) {
            $fullPath = storage_path('app/backups/' . $backup->filename);
        }

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }

        $backup->delete();

        return redirect()->back()->with('status', 'Backup record and SQL file deleted successfully.');
    }
}
