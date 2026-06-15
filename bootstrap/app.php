<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Throwable $e, Request $request) {

            if ($request->is('api/*')) {


                // 2. Handling Route & Resource Not Found
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'The requested URL was not found or the record ID does not exist.',
                    ], 404);
                }


                // 4. Handling Invalid HTTP Method
                if ($e instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'status'  => false,
                        'message' => "The " . $request->method() . " method is not supported for this route.",
                    ], 405);
                }
            }
        });
    })->create();
