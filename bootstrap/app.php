<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\StoreEmployee;
use App\Http\Middleware\StoreOwner;
use App\Http\Middleware\CoAdmin;
use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\StoreIsActive;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // loads the routes here.
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

   ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => CheckRole::class,
            'store.active' => StoreIsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();

    