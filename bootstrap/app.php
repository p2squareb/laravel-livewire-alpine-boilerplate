<?php

use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\BoardAuthCheck;
use App\Http\Middleware\CacheConfig;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminCheck::class,
            'config' => CacheConfig::class,
            'board-auth-check' => BoardAuthCheck::class,
        ]);
        $middleware->web([
            'config',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
