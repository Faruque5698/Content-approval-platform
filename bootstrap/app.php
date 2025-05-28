<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminCheckMiddleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => AdminCheckMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (HttpException $e, $request) {
            $statusCode = $e->getStatusCode();
            Log::error('Exception caught', [
                'message' => $e->getMessage(),
                'code' => $statusCode,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            switch ($statusCode) {
                case 404:
                    Toastr::error('Record not found.', 'Error', ['positionClass' => 'toast-top-right']);
                    return redirect()->route('admin.users.index');

                case 405:
                    Toastr::error('Method not allowed.', 'Error', ['positionClass' => 'toast-top-right']);
                    return redirect()->back();

                case 500:
                default:
                    Toastr::error($e->getMessage() ?: 'Something went wrong!', 'Error', ['positionClass' => 'toast-top-right']);
                    return redirect()->back();
            }
        });
    })->create();
