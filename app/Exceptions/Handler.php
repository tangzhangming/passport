<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;

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
            //
        });
    }

    public function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        if( $request->is('web-api/*') ){
            return response()->json([
                'code' => 419,
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ]);
        }

        return parent::convertValidationExceptionToResponse($e, $request);
    }
}
