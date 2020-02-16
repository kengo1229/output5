<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use \Illuminate\Auth\Passwords\PasswordBroker;
use \Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // パスワード再設定完了後にメッセージを表示したいので、sendResetResponseメソッドをオーバーライド
    protected function sendResetResponse(Request $request, $response)
    {
        // リダイレクト先でフラッシュメッセージを表示する
        return redirect($this->redirectPath())
                            ->with('flash_message', trans($response));
    }


    // パスワードリセットのバリデーションでPasswordBrokerを返す前にvalidatorを呼ぶように変更
    public function broker()
    {
        $broker = Password::broker();
        $broker->validator(function(array $credentials) { return true; });
        return $broker;
 
    }

}
