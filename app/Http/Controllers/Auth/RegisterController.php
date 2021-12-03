<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\FullWidthKana;
use App\Rules\MinBikou;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // /**
    //  * Where to redirect users after registration.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * 新規会員作成画面の表示
     *
     * @return void
     */
    public function showNewAccountEdit()
    {
        return view('new_account_edit');
    }

    /**
     * 新規会員作成確認画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showNewAccountConf(Request $request)
    {
        // 直接遷移対策
        if(!$request->session()->has('form_input.conf')){
            return redirect()->route('new_account_edit');
        }
        // conf画面に遷移
        return view('new_account_conf');
    }

    /**
     * 登録完了画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showNewAccountDone(Request $request)
    {
        // 直接遷移対策
        if(!$request->session()->has('send')){
            return redirect()->route('new_account_edit');
        }
        // done画面に遷移
        return view('new_account_done');
    }

    /**
     * バリデーション処理
     *
     * @param Request $request
     * @return void
     */
    public function validateNewAccount(Request $request)
    {
        // バリデーションチェックを実施
        $validator = Validator::make($request->all(),[
            'login_id' => 'required | unique:users,login_id',
            'login_pass' => 'required',
            'name' => 'required',
            'name_kana' => ['required', New FullWidthKana()],
            'gender' => 'required',
            'mail' => 'required | email | unique:users,mail',
            'mail_confirm' => 'required | same:mail',
            'tel1' => 'required',
            'tel2' => 'required',
            'tel3' => 'required',
            'postal_code1' => 'required',
            'postal_code2' => 'required',
            'pref' => 'required',
            'city' => 'required',
            'address' => 'required',
            'memo' => New MinBikou(),
        ]);
        if($validator->fails()){
            return redirect()->route('new_account_edit')->withInput()->withErrors($validator);
        }

        // conf画面に遷移
        return redirect()->route('new_account_conf')->with(['form_input' => $request->all()]);
    }

    /**
     * conf画面のform処理
     *
     * @param Request $request
     * @return void
     */
    public function sendConfForm(Request $request)
    {
        if($request->has('back')){ // 修正ボタンが押下されたら
            return redirect()->route('new_account_edit')->withInput($request->all());
        }

        // データベース登録処理
        $this->create($request->all());
        // 二重送信対策
        $request->session()->regenerateToken();

        try {
            // メール送信処理
            if(!$this->sendMail($request->all())){
                throw new \Exception();
            };
        } catch (\Exception $e) {
            $message = config('exception.original_status.001');
            return response()->view('errors.common', ['message' => $message]);
        }

        return redirect()->route('new_account_done')->with(['send' => $request->only('send')]);
    }

    /**
     * 新規会員登録処理
     *
     * @param  array  $user_info
     * @return \App\User
     */
    protected function create(array $user_info)
    {
        $user = User::create([
            'login_id' => $user_info['login_id'],
            'password' => Hash::make($user_info['login_pass']),
            'name' => $user_info['name'],
            'name_kana' => $user_info['name_kana'],
            'birth_year' => $user_info['birth_year'],
            'birth_month' => $user_info['birth_month'],
            'birth_day' => $user_info['birth_day'],
            'gender' => $user_info['gender'],
            'mail' => $user_info['mail'],
            'tel1' => $user_info['tel1'],
            'tel2' => $user_info['tel2'],
            'tel3' => $user_info['tel3'],
            'postal_code1' => $user_info['postal_code1'],
            'postal_code2' => $user_info['postal_code2'],
            'pref' => $user_info['pref'],
            'city' => $user_info['city'],
            'address' => $user_info['address'],
            'other' => $user_info['other'],
            'memo' => $user_info['memo'],
            'status' => 1
        ]);

        // ログイン処理
        $this->guard()->login($user);
    }

    /**
     * メール送信処理
     *
     * @param array $user_info
     * @return void
     */
    public function sendMail(array $user_info)
    {
        Mail::to($user_info['mail'])->send(new RegisterMail($user_info));
    }
}
