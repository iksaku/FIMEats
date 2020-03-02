<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /*
     * Return error view
     */
    protected function renderHttpException(HttpExceptionInterface $e): Response
    {
        if ($e->getPrevious() instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException(
                'No se ha encontrado el recurso solicitado.',
                $e->getPrevious()
            );
        }

        return response()->view('error', [
            'exception' => $e,
        ], $e->getStatusCode(), $e->getHeaders());
    }
}
