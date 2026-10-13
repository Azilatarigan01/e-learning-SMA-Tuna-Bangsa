<?php

header('Content-Type: text/html; charset=utf-8');

try {
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

    if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
        echo "<div style='font-family:sans-serif;padding:30px;'>";
        echo "<h2>DIAGNOSTIC: vendor/autoload.php not found!</h2>";
        echo "<p>Root directory contents:</p><pre>";
        print_r(scandir(__DIR__ . '/..'));
        echo "</pre></div>";
        exit;
    }

    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Override storage path to /tmp/storage
    $app->useStoragePath($storagePath);

    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = \Illuminate\Http\Request::capture()
    )->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    http_response_code(200); // Prevent Vercel 500 FUNCTION_INVOCATION_FAILED wrapper
    echo "<div style='font-family:sans-serif;padding:30px;background:#fff3f3;border:2px solid #e3342f;border-radius:8px;margin:20px;'>";
    echo "<h2 style='color:#e3342f;margin-top:0;'>⚠️ Laravel Crash Diagnostic on Vercel:</h2>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (line " . $e->getLine() . ")</p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre style='background:#fff;padding:15px;border:1px solid #ddd;border-radius:4px;overflow-x:auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
    exit;
}
