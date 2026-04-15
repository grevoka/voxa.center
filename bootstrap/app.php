<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'set-locale' => \App\Http\Middleware\SetLocale::class,
            'admin-locale' => \App\Http\Middleware\SetAdminLocale::class,
            'client-locale' => \App\Http\Middleware\SetClientLocale::class,
            'section' => \App\Http\Middleware\CheckSection::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
