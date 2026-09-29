<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SetupAdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:setup 
                            {--email=admin@tamalchakraborty.com : Admin email address} 
                            {--name=AstroTamal Administrator : Admin name}
                            {--password= : Optional custom password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update the administrator account with a secure temporary password';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->option('email');
        $name = $this->option('name');
        $customPassword = $this->option('password');

        $isNewPassword = false;
        if (!empty($customPassword)) {
            $password = $customPassword;
        } else {
            $password = Str::random(14) . '!@A';
            $isNewPassword = true;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'is_admin' => true,
                'is_active' => true,
                'must_change_password' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->info('====================================================');
        $this->info(' ASTROTAMAL ADMIN ACCOUNT CONFIGURED SUCCESSFULLY');
        $this->info('====================================================');
        $this->table(
            ['Field', 'Value'],
            [
                ['Name', $user->name],
                ['Email', $user->email],
                ['Status', $user->is_active ? 'Active' : 'Disabled'],
                ['Role', $user->is_admin ? 'Administrator' : 'User'],
                ['Temporary Password', $password],
            ]
        );
        $this->warn('Please log in at /admin/login and change your temporary password immediately.');
        $this->info('====================================================');

        return Command::SUCCESS;
    }
}
