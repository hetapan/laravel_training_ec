@extends('template')
@section('content')
    <section class="register">
        <h2 class="register_title">入力内容の確認</h2>
        <p class="register_txt">入力内容に問題なければ、送信するボタンを押してください。</p>
        <div class="register_form_panel">
            <h2 class="register_form_title">会員情報入力</h2>
            <table>
                <tr>
                    <th>ログインID</th>
                    <td>{{ Session::get('form_input.login_id') }}</td>
                </tr>
                <tr>
                    <th>ログインパスワード</th>
                    <td>{{ str_repeat('*', mb_strlen(Session::get('form_input.login_pass'), 'UTF8')) }}</td>
                </tr>
                <tr>
                    <th>ユーザ名</th>
                    <td>{{ Session::get('form_input.name') }}</td>
                </tr>
                <tr>
                    <th>ユーザ名カナ</th>
                    <td>{{ Session::get('form_input.name_kana') }}</td>
                </tr>
                <tr>
                    <th>誕生日</th>
                    <td>
                        {{ Session::get('form_input.birth_year') != '' ? config('const.common.birth_year.' . Session::get('form_input.birth_year')) : ' ' }} /
                        {{ Session::get('form_input.birth_month') != '' ? config('const.common.birth_month.' . Session::get('form_input.birth_month')) : ' ' }} /
                        {{ Session::get('form_input.birth_day') != '' ? config('const.common.birth_day.' . Session::get('form_input.birth_day')) : ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>{{ config('const.common.gender.' . Session::get('form_input.gender')) }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ Session::get('form_input.mail') }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        {{ Session::get('form_input.tel1') }} -
                        {{ Session::get('form_input.tel2') }} -
                        {{ Session::get('form_input.tel3') }}
                    </td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td>
                        {{ Session::get('form_input.postal_code1') }} -
                        {{ Session::get('form_input.postal_code2') }}
                    </td>
                </tr>
                <tr>
                    <th>都道府県</th>
                    <td>{{ Session::get('form_input.pref') != '' ? config('const.common.pref.' . Session::get('form_input.pref')) : '' }}</td>
                </tr>
                <tr>
                    <th>市区町村</th>
                    <td>{{ Session::get('form_input.city') }}</td>
                </tr>
                <tr>
                    <th>番地</th>
                    <td>{{ Session::get('form_input.address') }}</td>
                </tr>
                <tr>
                    <th>マンション名等</th>
                    <td>{{ Session::get('form_input.other') }}</td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td>{!! nl2br(e(Session::get('form_input.memo'))) !!}</td>
                </tr>
            </table>
            <form action="{{ url('new_account_conf') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="login_id" value="{{ Session::get('form_input.login_id') }}">
                <input type="hidden" name="login_pass" value="{{ Session::get('form_input.login_pass') }}">
                <input type="hidden" name="name" value="{{ Session::get('form_input.name') }}">
                <input type="hidden" name="name_kana" value="{{ Session::get('form_input.name_kana') }}">
                <input type="hidden" name="birth_year" value="{{ Session::get('form_input.birth_year') }}">
                <input type="hidden" name="birth_month" value="{{ Session::get('form_input.birth_month') }}">
                <input type="hidden" name="birth_day" value="{{ Session::get('form_input.birth_day') }}">
                <input type="hidden" name="gender" value="{{ Session::get('form_input.gender') }}">
                <input type="hidden" name="mail" value="{{ Session::get('form_input.mail') }}">
                <input type="hidden" name="mail_confirm" value="{{ Session::get('form_input.mail_confirm') }}">
                <input type="hidden" name="tel1" value="{{ Session::get('form_input.tel1') }}">
                <input type="hidden" name="tel2" value="{{ Session::get('form_input.tel2') }}">
                <input type="hidden" name="tel3" value="{{ Session::get('form_input.tel3') }}">
                <input type="hidden" name="postal_code1" value="{{ Session::get('form_input.postal_code1') }}">
                <input type="hidden" name="postal_code2" value="{{ Session::get('form_input.postal_code2') }}">
                <input type="hidden" name="pref" value="{{ Session::get('form_input.pref') }}">
                <input type="hidden" name="city" value="{{ Session::get('form_input.city') }}">
                <input type="hidden" name="address" value="{{ Session::get('form_input.address') }}">
                <input type="hidden" name="other" value="{{ Session::get('form_input.other') }}">
                <input type="hidden" name="memo" value="{{ Session::get('form_input.memo') }}">
                <p class="register_form_submit"><input type="submit" name="send" value="送信する"></p>
                <p class="register_form_submit cancel_btn"><input type="submit" name="back" value="修正する"></p>
            </form>
        </div>
    </section>
@endsection
