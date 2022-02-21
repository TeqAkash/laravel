<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception){
       
        if ($request->wantsJson()&&!$request->ajax()) {
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['status' => false, 'response' => new \stdClass(), 'code' => Response::HTTP_FORBIDDEN, 'message' => 'Unauthenticated.'], Response::HTTP_FORBIDDEN);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['status' => false, 'response' => new \stdClass(), 'code' => Response::HTTP_FORBIDDEN, 'message' => 'URL not found.'], Response::HTTP_OK);
            }

            // custom error message
            if ($exception instanceof \ErrorException) {
                \Log::error($exception->getMessage());
                \Log::error($exception->getTraceAsString());
                
                return response()->json(['status' => false, 'response' => new \stdClass(), 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => 'Server Error.'], Response::HTTP_OK);
            }
            // } else if ($exception instanceof ValidationException) {
        }
                return parent::render($request, $exception);
    }
}
