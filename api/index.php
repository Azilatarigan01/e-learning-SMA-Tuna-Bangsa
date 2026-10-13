<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

// Catch and display errors if needed
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('LARAVEL_START', microtime(true));

// Setup writable storage directory for Vercel Serverless environment
$storagePath = '/tmp/storage';
foreach ([
    $storagePath,
    $storagePath . '/framework',
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    $storagePath . '/app',
    $storagePath . '/app/public',
] as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override storage path to /tmp/storage
$app->useStoragePath($storagePath);

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
