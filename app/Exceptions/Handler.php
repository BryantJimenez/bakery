<?php

namespace App\Exceptions;

use Throwable;
use JoeDixon\Translation\Language;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Spatie\Permission\Exceptions\UnauthorizedException;

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

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->has('locale') && !is_null($request->locale)) {
            $language=Language::where('language', $request->locale)->first();
            if (!is_null($language)) {
                app()->setLocale($language->language);
            }
        }
        if (request()->header('Content-Type')=='application/json' || (isset(explode('/', $request->url())[3]) && explode('/', $request->url())[3]=="api")) {
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['code' => 405, 'status' => 'error', 'message' => trans('errors.exceptions.405')], 405);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['code' => 404, 'status' => 'error', 'message' => trans('errors.exceptions.404')], 404);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json(['code' => 401, 'status' => 'error', 'message' => trans('errors.exceptions.401')], 401);
            }

            if ($exception instanceof UnauthorizedException) {
                return response()->json(['code' => 403, 'status' => 'error', 'message' => trans('errors.exceptions.403')], 403);
            }

            if ($exception instanceof ValidationException) {
                return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('errors.exceptions.422'), 'errors' => $exception->validator->getMessageBag()], 422);
            }
        }

        if ($request->ajax()) {
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['code' => 405, 'status' => false, 'message' => trans('errors.exceptions.405')], 405);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['code' => 404, 'status' => false, 'message' => trans('errors.exceptions.404')], 404);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json(['code' => 401, 'status' => false, 'message' => trans('errors.exceptions.401')], 401);
            }

            if ($exception instanceof UnauthorizedException) {
                return response()->json(['code' => 403, 'status' => false, 'message' => trans('errors.exceptions.403')], 403);
            }

            if ($exception instanceof ValidationException) {
                return response()->json(['code' => 422, 'status' => false, 'message' => trans('errors.exceptions.422'), 'errors' => $exception->validator->getMessageBag()], 422);
            }
        }

        return parent::render($request, $exception);
    }
}