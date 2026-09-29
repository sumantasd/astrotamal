<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = DB::select('SHOW TABLES');
foreach ($tables as $t) {
    $tableArray = (array) $t;
    $name = reset($tableArray);
    echo "=== TABLE: {$name} ===\n";
    $cols = Schema::getColumnListing($name);
    echo implode(', ', $cols) . "\n\n";
}
