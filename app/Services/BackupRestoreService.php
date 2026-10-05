<?php

namespace App\Services;

use App\Models\BackupHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BackupRestoreService
{
    /**
     * Create a complete SQL database backup.
     */
    public static function createBackup(string $type = 'manual'): BackupHistory
    {
        $backupDir = storage_path('app/backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true, true);
        }

        $timestamp = Carbon::now()->format('Y_m_d_H_i_s');
        $prefix = $type === 'pre_restore' ? 'pre_restore' : 'astrotamal_backup';
        $filename = "{$prefix}_{$timestamp}.sql";
        $sqlPath = "{$backupDir}/{$filename}";

        // 1. Export Database SQL
        self::exportDatabaseSql($sqlPath);

        // 2. Prepare Manifest Metadata
        $manifest = [
            'app_name' => 'AstroTamal / Ganesha Astro Consultancy',
            'created_at' => Carbon::now()->toIso8601String(),
            'laravel_version' => app()->version(),
            'type' => $type,
            'db_driver' => DB::connection()->getDriverName(),
            'database_name' => DB::connection()->getDatabaseName(),
        ];

        $sizeBytes = File::size($sqlPath);

        return BackupHistory::create([
            'filename' => $filename,
            'path' => "backups/{$filename}",
            'size_bytes' => $sizeBytes,
            'type' => $type,
            'manifest' => $manifest,
        ]);
    }

    /**
     * Export database to SQL file using PDO and Laravel DB queries.
     * Supports MySQL, MariaDB, and SQLite (used in test suite).
     */
    public static function exportDatabaseSql(string $outputPath): void
    {
        $connection = DB::connection();
        $pdo = $connection->getPdo();
        $driver = $connection->getDriverName();
        $databaseName = $connection->getDatabaseName();

        $tables = [];

        if ($driver === 'sqlite') {
            $results = $connection->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
            foreach ($results as $result) {
                $tables[] = $result->name;
            }
        } else {
            // MySQL / MariaDB / Postgres
            $results = $connection->select('SHOW TABLES');
            foreach ($results as $result) {
                $array = (array) $result;
                $tables[] = reset($array);
            }
        }

        $sql = "-- AstroTamal Database Export\n";
        $sql .= "-- Generated: " . Carbon::now()->toDateTimeString() . "\n";
        $sql .= "-- Database Driver: " . $driver . "\n";
        $sql .= "-- Database Name: " . $databaseName . "\n\n";

        if ($driver === 'sqlite') {
            $sql .= "PRAGMA foreign_keys = OFF;\n\n";
        } else {
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
        }

        foreach ($tables as $table) {
            $sql .= "-- Table structure for `{$table}`\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";

            if ($driver === 'sqlite') {
                $createStmt = $connection->select("SELECT sql FROM sqlite_master WHERE type='table' AND name = ?", [$table]);
                if (!empty($createStmt) && isset($createStmt[0]->sql)) {
                    $sql .= $createStmt[0]->sql . ";\n\n";
                }
            } else {
                $createStmt = $connection->select("SHOW CREATE TABLE `{$table}`");
                if (!empty($createStmt)) {
                    $rowArray = (array) $createStmt[0];
                    $createSql = $rowArray['Create Table'] ?? null;
                    if ($createSql) {
                        $sql .= $createSql . ";\n\n";
                    }
                }
            }

            // Table Data
            $rows = $connection->table($table)->get();
            if ($rows->isNotEmpty()) {
                $sql .= "-- Dumping data for `{$table}`\n";
                foreach ($rows->chunk(100) as $chunk) {
                    $sql .= "INSERT INTO `{$table}` VALUES \n";
                    $values = [];
                    foreach ($chunk as $row) {
                        $rowArray = (array) $row;
                        $escapedValues = array_map(function ($val) use ($pdo) {
                            if (is_null($val)) {
                                return 'NULL';
                            }
                            return $pdo->quote($val);
                        }, $rowArray);
                        $values[] = "(" . implode(', ', $escapedValues) . ")";
                    }
                    $sql .= implode(",\n", $values) . ";\n";
                }
                $sql .= "\n";
            }
        }

        if ($driver === 'sqlite') {
            $sql .= "PRAGMA foreign_keys = ON;\n";
        } else {
            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        }

        File::put($outputPath, $sql);
    }

    /**
     * Validate a backup SQL file for security & SQL structure.
     */
    public static function validateBackupSql(string $sqlPath): array
    {
        if (!File::exists($sqlPath)) {
            return ['valid' => false, 'error' => 'Backup file does not exist on server.'];
        }

        $filename = basename($sqlPath);

        // Path Traversal Security check
        if (str_contains($sqlPath, '../') || str_contains($sqlPath, '..\\')) {
            return ['valid' => false, 'error' => 'Security check failed: path traversal detected.'];
        }

        // Check file extension (.sql)
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($ext !== 'sql') {
            return ['valid' => false, 'error' => 'Invalid file format: Backup must be a .sql file.'];
        }

        // Check file size (max 50MB, non-empty)
        $size = File::size($sqlPath);
        if ($size === 0) {
            return ['valid' => false, 'error' => 'Uploaded backup file is empty.'];
        }
        if ($size > 52428800) {
            return ['valid' => false, 'error' => 'Backup file exceeds maximum allowed size of 50MB.'];
        }

        // Inspect file content
        $content = File::get($sqlPath);

        // Ensure file does not contain .env secrets
        if (str_contains($content, 'APP_KEY=') || str_contains($content, 'DB_PASSWORD=')) {
            return ['valid' => false, 'error' => 'Security check failed: file contains prohibited .env secrets.'];
        }

        // Basic SQL signature validation
        $hasSqlKeywords = str_contains($content, 'CREATE TABLE') || 
                          str_contains($content, 'INSERT INTO') || 
                          str_contains($content, 'AstroTamal Database Export') ||
                          str_contains($content, 'DROP TABLE');

        if (!$hasSqlKeywords) {
            return ['valid' => false, 'error' => 'File content does not appear to be a valid database SQL backup.'];
        }

        return [
            'valid' => true,
            'filename' => $filename,
            'size' => $size,
        ];
    }

    /**
     * Legacy alias for backwards compatibility.
     */
    public static function validateBackupZip(string $path): array
    {
        return self::validateBackupSql($path);
    }

    /**
     * Restore database from a validated SQL backup file.
     */
    public static function restoreBackup(string $sqlPath): bool
    {
        $validation = self::validateBackupSql($sqlPath);
        if (!$validation['valid']) {
            throw new \InvalidArgumentException($validation['error']);
        }

        // 1. AUTOMATIC PRE-RESTORE SAFETY BACKUP
        self::createBackup('pre_restore');

        // 2. Execute Database SQL file against DB connection safely
        $sqlContent = File::get($sqlPath);

        try {
            DB::unprepared($sqlContent);
            self::syncDiskBackupsWithDatabase();
            return true;
        } catch (\Throwable $e) {
            Log::error('Database restore failed: ' . $e->getMessage());
            throw new \RuntimeException('Failed to restore database SQL: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Ensure all SQL backup files on disk are tracked in the database history table.
     */
    public static function syncDiskBackupsWithDatabase(): void
    {
        $backupDir = storage_path('app/backups');
        if (!File::exists($backupDir)) {
            return;
        }

        $files = File::files($backupDir);
        foreach ($files as $file) {
            if (!File::exists($file->getPathname())) {
                continue;
            }

            $filename = $file->getFilename();
            if (!str_ends_with(strtolower($filename), '.sql')) {
                continue;
            }

            $type = str_starts_with($filename, 'pre_restore') ? 'pre_restore' : 'manual';
            $sizeBytes = @File::size($file->getPathname()) ?: 0;
            $path = "backups/{$filename}";

            BackupHistory::firstOrCreate(
                ['filename' => $filename],
                [
                    'path' => $path,
                    'size_bytes' => $sizeBytes,
                    'type' => $type,
                    'manifest' => [
                        'app_name' => 'AstroTamal / Ganesha Astro Consultancy',
                        'type' => $type,
                    ],
                    'created_at' => Carbon::createFromTimestamp($file->getMTime()),
                ]
            );
        }
    }
}
