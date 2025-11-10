<?php

// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware; // Pastikan Anda mengimpor kelas middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- 1. Middleware Groups (Sama dengan 'web' dan 'api' di kernel lama) ---
        // Jika Anda ingin menambahkan middleware ke grup 'web', lakukan di sini:
        // $middleware->web(append: [
        //     // ... middleware tambahan untuk web
        // ]);

        // --- 2. Route Middleware Aliases (Sama dengan $routeMiddleware di kernel lama) ---
        $middleware->alias([
            'admin' => AdminMiddleware::class, // <-- Tambahkan alias 'admin' di sini
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // ... Konfigurasi Exceptions
    })->create();