<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckFirstLogin;
use App\Http\Middleware\CheckPasswordExpired;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'checkFirstLogin' => CheckFirstLogin::class,
            'checkPasswordExpired' => CheckPasswordExpired::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        //
    })
    ->create();
