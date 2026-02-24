<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Custom rendering for Admin Panel
        $exceptions->render(function (Throwable $e, Request $request) {

            // Only intercept if the URL starts with /admin
            if ($request->is('admin/*')) {

                // Determine the status code
                $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

                // Map status codes to specific admin views
                // You can create views like admin.errors.404, admin.errors.500, etc.
                if (view()->exists("Admin.Exceptions.{$statusCode}")) {
                    return response()->view("Admin.Exceptions.{$statusCode}", [
                        'exception' => $e,
                    ], $statusCode);
                }

                // Generic fallback for any other admin errors
                return response()->view('Admin.Exceptions.500', [
                    'exception' => $e,
                ], 500);
            }
        });
    })->create();
