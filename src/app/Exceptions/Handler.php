<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Whoops\Handler\PrettyPageHandler;

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
     * @param Exception $exception
     *
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @author : Phi .
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ( $this->isModelExp( $exception ) && $this->isHttpApi($request)) {
            return response()->json([
                'error' => 'Invalid Parameter Value in the Request.'
            ], Response::HTTP_NOT_FOUND );
        }

        if ( $this->isHttpExp( $exception ) && $this->isHttpApi($request)) {
            return response()->json([
                'error' => 'Invalid Route or Parameter in the Request.'
            ], Response::HTTP_BAD_REQUEST );
        }

        if ($exception instanceof TokenMismatchException) {

            return Redirect::back();
        }

        if ($exception instanceof PrettyPageHandler || $exception instanceof \Swift_TransportException) {

            return Redirect::back();
        }

        return parent::render($request, $exception);
    }

    /**
     * @author : Phi .
     * @param $request
     * @return bool
     */
    public function isHttpApi($request)
    {
        $segment = $request->segment(1);

        if (!empty($segment) && ($segment == 'api')){
            return true;
        }

        return false;
    }

    /**
     * if its a model not found exception
     * @param $exception
     *
     * @return bool
     */
    public function isModelExp( $exception )
    {
        return $exception instanceof ModelNotFoundException;
    }

    /**
     * if its an http not found exception
     * @param $exception
     *
     * @return bool
     */
    public function isHttpExp( $exception )
    {
        return $exception instanceof NotFoundHttpException;
    }
}
