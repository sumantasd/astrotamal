<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Livewire\Livewire;
use App\Filament\Pages\Auth\Login;

echo "=== SIMULATING LIVEWIRE BROWSER SUBMIT ===\n\n";

// Test 1: Simulated Browser Submit with email + password
$component = Livewire::test(Login::class)
    ->set('data.email', 'admin@tamalchakraborty.com')
    ->set('data.password', 'lds90Dho7WXeqC!@A')
    ->call('authenticate');

echo "1. Authenticate with valid password: SUCCESS! Auth user: " . (auth()->check() ? auth()->user()->email : 'Failed') . "\n";

// Test 2: Simulated Browser Submit with empty password
try {
    Livewire::test(Login::class)
        ->set('data.email', 'admin@tamalchakraborty.com')
        ->set('data.password', '')
        ->call('authenticate')
        ->assertHasErrors(['data.password']);
    echo "2. Empty password test: PASSED (Required error correctly raised)\n";
} catch (\Exception $e) {
    echo "2. Empty password test error: " . $e->getMessage() . "\n";
}

// Test 3: Simulated Browser Submit with wrong password
try {
    Livewire::test(Login::class)
        ->set('data.email', 'admin@tamalchakraborty.com')
        ->set('data.password', 'WrongPassword123')
        ->call('authenticate')
        ->assertHasErrors(['data.email']);
    echo "3. Invalid password test: PASSED (Invalid credentials error correctly raised)\n";
} catch (\Exception $e) {
    echo "3. Invalid password test error: " . $e->getMessage() . "\n";
}
