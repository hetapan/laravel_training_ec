<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class AdminLoginController extends Controller
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
        if(Auth::guard('admin')->check()){ //認証済みならば
            // ログアウト処理を行う
            $this->logout($request);
        }
        return view('admin/login');
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
        return redirect()->route('admin_login');
    }

    /**
     * 参照するguardの変更処理
     *
     * @return object
     */
    protected function guard()
    {
        return Auth::guard('admin');
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
        $this->guard('admin')->logout();
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
        return 'admin/top';
    }
}
