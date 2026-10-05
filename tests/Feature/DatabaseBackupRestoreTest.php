<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\BackupHistory;
use App\Services\BackupRestoreService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class DatabaseBackupRestoreTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin_test_' . uniqid() . '@example.com',
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    /** @test */
    public function admin_can_open_backup_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.backup.index'));

        $response->assertOk();
        $response->assertSee('Database Backup & Restore');
        $response->assertSee('CREATE SQL BACKUP');
    }

    /** @test */
    public function admin_can_create_sql_backup()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.backup.create'));

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('backup_histories', [
            'type' => 'manual',
        ]);
    }

    /** @test */
    public function generated_backup_file_exists()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);

        $this->assertTrue(File::exists($fullPath));
    }

    /** @test */
    public function generated_backup_contains_sql()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);
        $content = File::get($fullPath);

        $this->assertStringContainsString('-- AstroTamal Database Export', $content);
        $this->assertStringContainsString('DROP TABLE IF EXISTS', $content);
    }

    /** @test */
    public function backup_does_not_contain_env()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);
        $content = File::get($fullPath);

        $this->assertStringNotContainsString('APP_KEY=', $content);
        $this->assertStringNotContainsString('DB_PASSWORD=', $content);
    }

    /** @test */
    public function backup_does_not_expose_database_credentials()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);
        $content = File::get($fullPath);

        $dbPassword = config('database.connections.mysql.password');
        if (!empty($dbPassword)) {
            $this->assertStringNotContainsString($dbPassword, $content);
        }
        $this->assertStringNotContainsString('DB_PASSWORD=', $content);
    }

    /** @test */
    public function backup_download_requires_admin_authentication()
    {
        $backup = BackupRestoreService::createBackup('manual');

        auth()->logout();

        $guestResponse = $this->get(route('admin.settings.backup.download', $backup));
        $guestResponse->assertRedirect(route('admin.login'));

        $adminResponse = $this->actingAs($this->admin)->get(route('admin.settings.backup.download', $backup));
        $adminResponse->assertOk();
        $adminResponse->assertHeader('content-type', 'application/sql');
    }

    /** @test */
    public function invalid_upload_is_rejected()
    {
        $file = UploadedFile::fake()->create('invalid.sql', 10, 'text/plain');
        file_put_contents($file->getPathname(), 'this is not valid sql content');

        $response = $this->actingAs($this->admin)->post(route('admin.settings.backup.upload-restore'), [
            'backup_file' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /** @test */
    public function non_sql_upload_is_rejected()
    {
        $file = UploadedFile::fake()->create('script.php', 10, 'application/x-php');

        $response = $this->actingAs($this->admin)->post(route('admin.settings.backup.upload-restore'), [
            'backup_file' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /** @test */
    public function restore_creates_a_pre_restore_safety_backup()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);

        $initialCount = BackupHistory::where('type', 'pre_restore')->count();

        BackupRestoreService::restoreBackup($fullPath);

        $newCount = BackupHistory::where('type', 'pre_restore')->count();
        $this->assertGreaterThan($initialCount, $newCount);
    }

    /** @test */
    public function restore_route_requires_admin_authentication()
    {
        $backup = BackupRestoreService::createBackup('manual');

        auth()->logout();

        $guestResponse = $this->post(route('admin.settings.backup.restore', $backup));
        $guestResponse->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function failed_restore_shows_a_proper_error()
    {
        $dummyPath = storage_path('app/backups/corrupt_dummy.sql');
        File::makeDirectory(storage_path('app/backups'), 0755, true, true);
        File::put($dummyPath, 'invalid string content');

        $this->expectException(\InvalidArgumentException::class);
        BackupRestoreService::restoreBackup($dummyPath);
    }
}
