<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web([
            \App\Http\Middleware\SetLocale::class
        ]);
        $middleware->alias([
            // 'member' => \App\Http\Middleware\AuthenticateMember::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'member' => \App\Http\Middleware\MemberMiddleware::class,
            'authenticate' => \App\Http\Middleware\Authenticate::class,
            'username' => \App\Http\Middleware\UsernameMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
