<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException || $exception instanceof PDOException) {
            return response()->view('errors.500', [], 500);
        } elseif ($exception instanceof AuthorizationException) {
            return response()->view('errors.403', [], 403);
        } elseif ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        } elseif ($exception instanceof ServiceUnavailableHttpException) {
            return response()->view('errors.503', [], 503);
        }

        return parent::render($request, $exception);
    }
}
