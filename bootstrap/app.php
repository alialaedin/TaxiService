<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->redirectGuestsTo(function (Request $request) {

      if (auth()->check()) {
        return null;
      }

      if ($request->is('family') || $request->is('family/*')) {
        return route('family.mobile-form');
      }elseif ($request->is('admin') || $request->is('admin/*')) {
        return route('admin.login');
      }elseif ($request->is('company') || $request->is('company/*')) {
        return route('company.login');
      }

      return url('/login');
    });
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
