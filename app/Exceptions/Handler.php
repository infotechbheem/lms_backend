<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Handle NotFoundHttpException for custom 404 page
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Handle UnauthorizedHttpException for custom 403 page
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->view('errors.403', [], 403);
        }

        // Handle QueryException for database errors
        if ($exception instanceof QueryException) {

            // Show a custom error page with details
            $errorMessage = $exception->getMessage();
            $sqlQuery = $exception->getSql();
            $bindings = $exception->getBindings();

            return response()->view('errors.sql', compact('errorMessage', 'sqlQuery', 'bindings'), 500);
        }

        // Handle BadMethodCallException for undefined method calls
        if ($exception instanceof BadMethodCallException) {
            return response()->view('errors.badMethod', [
                'message' => 'The method you are trying to access does not exist.',
            ], 500);
        }

        // Handle HttpException with specific status codes for custom error pages
        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();

            switch ($status) {
                case 400:
                    return response()->view('errors.400', [], 400);
                case 401:
                    return response()->view('errors.401', [], 401);
                case 403:
                    return response()->view('errors.403', [], 403);
                case 419:
                    return response()->view('errors.419', [], 419);
                case 429:
                    return response()->view('errors.429', [], 429);
                case 500:
                    return response()->view('errors.500', [], 500);
                case 503:
                    return response()->view('errors.503', [], 503);
            }
        }

        // Default error handling if no specific handler was found
        return parent::render($request, $exception);
    }
}
