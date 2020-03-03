<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    // ログイン後のリダイレクト先の変更とフラッシュメッセージの表示
    protected function authenticated(Request $request, $user)
    {
        // ログインしたら、ユーザー自身のプロフィールページへ移動
        return redirect('/')->with('flash_message', __('ログインしました。'));
    }

    // ログアウト後の遷移先をトップ画面に変更
    public function logout(Request $request)
    {
        Auth::logout();

        $this->guard()->logout();

        $request->session()->invalidate();

        // /homeに変更
        return $this->loggedOut($request) ?: redirect('/')->with('flash_message', __('ログアウトしました。'));
    }
}