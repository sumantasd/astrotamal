<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Filament\Facades\Filament;

$user = User::where('email', 'admin@tamalchakraborty.com')->first();
if ($user) {
    echo "User found:\n";
    echo "ID: " . $user->id . "\n";
    echo "Email: " . $user->email . "\n";
    echo "is_admin: " . ($user->is_admin ? 'TRUE' : 'FALSE') . "\n";
    echo "is_active: " . ($user->is_active ? 'TRUE' : 'FALSE') . "\n";
    echo "canAccessPanel: " . ($user->canAccessPanel(Filament::getCurrentOrDefaultPanel()) ? 'TRUE' : 'FALSE') . "\n";
} else {
    echo "USER NOT FOUND!\n";
}
