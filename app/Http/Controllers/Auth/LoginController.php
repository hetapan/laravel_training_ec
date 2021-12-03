<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

        /**
     * ログイン画面の表示
     *
     * @return void
     */
    public function showLogin(Request $request)
    {
        if(Auth::check()){ //認証済みならば
            // ログアウト処理を行う
            $this->logout($request);
        }
        return view('login');
    }

        /**
     * マイページの表示
     *
     * @return void
     */
    public function showMypage()
    {
        return view('my_page');
    }

        /**
     * ログアウト画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showLogout(Request $request)
    {
        $this->logout($request);
        return redirect()->route('index');
    }

    /**
     * ログイン処理
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

        /**
     * ログアウト処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /**
     * ログイン認証のフォーム名
     *
     * @return string
     */
    public function username()
    {
      return 'login_id';
    }

    /**
     * リダイレクト先
     *
     * @return void
     */
    public function redirectPath()
    {
        return 'my_page';
    }
}
