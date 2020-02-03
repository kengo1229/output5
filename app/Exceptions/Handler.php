<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

     //ログイン有効期限切れの場合、ログイン画面に遷移させてフラッシュメッセージを表示する
     public function render($request, Exception $e)
     {
         if ($e instanceof TokenMismatchException) {

             \Session::flash('flash_message', 'ログイン有効期限が切れました。ログインし直してください。');
             return redirect()->route('login');
         }

         return parent::render($request, $e);
     }
}

// もしダメだったら元のコードに帰る
// public function render($request, Exception $exception)
// {
//     return parent::render($request, $exception);
// }
