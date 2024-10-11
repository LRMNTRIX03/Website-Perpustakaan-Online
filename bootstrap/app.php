<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserAkses;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'UserAkses' => UserAkses::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
