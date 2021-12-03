@extends('template')
@section('content')
    <section class="register">
        <h2 class="register_title">新規会員登録 入力画面</h2>
        @if ($errors->any())
            <p class="register_txt error">エラー内容を確認してください。</p>
        @else
            <p class="register_txt">お客様情報を入力して会員登録を完了してください。</p>
        @endif
        <div class="register_form_panel">
            <h2 class="register_form_title">会員情報入力</h2>
            <form action="{{ url('new_account_edit') }}" method="post">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <th>ログインID<span>必須</span></th>
                        <td>
                            <input type="text" name="login_id" value="{{ old('login_id') }}" placeholder="例： je28v75c">
                            @if ($errors->has('login_id'))
                                <span>{{ $errors->first('login_id') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>ログインパスワード<span>必須</span></th>
                        <td>
                            <input type="password" name="login_pass" value="{{ old('login_pass') }}" placeholder="例： Ac53oxbd3">
                            @if ($errors->has('login_pass'))
                                <span>{{ $errors->first('login_pass') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>ユーザ名<span>必須</span></th>
                        <td>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="例： 田中太郎">
                            @if ($errors->has('name'))
                                <span>{{ $errors->first('name') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>ユーザ名カナ<span>必須</span></th>
                        <td>
                            <input type="text" name="name_kana" value="{{ old('name_kana') }}" placeholder="例： タナカタロウ">
                            @if ($errors->has('name_kana'))
                                <span>{{ $errors->first('name_kana') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>誕生日</th>
                        <td>
                            <select name="birth_year">
                                <option value="">----</option>
                                @foreach (config('const.common.birth_year') as $key => $birth_year)
                                    <option value="{{ $key }}"{{ $key == old('birth_year') ? ' selected' : '' }}>{{ $birth_year }}</option>
                                @endforeach
                            </select>
                            <select name="birth_month">
                                <option value="">--</option>
                                @foreach (config('const.common.birth_month') as $key => $birth_month)
                                    <option value="{{ $key }}"{{ $key == old('birth_month') ? ' selected' : '' }}>{{ $birth_month }}</option>
                                @endforeach
                            </select>
                            <select name="birth_day">
                                <option value="">--</option>
                                @foreach (config('const.common.birth_day') as $key => $birth_day)
                                    <option value="{{ $key }}"{{ $key == old('birth_day') ? ' selected' : '' }}>{{ $birth_day }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>性別<span>必須</span></th>
                        <td>
                            @foreach (config('const.common.gender') as $key => $gender)
                                <label>
                                    <input type="radio" name="gender"
                                        value="{{ $key }}"{{ $key == old('gender') || (empty(old('gender')) && $key == 1) ? ' checked' : '' }}>
                                    {{ $gender }}
                                </label>
                            @endforeach
                            @if ($errors->has('gender'))
                                <span>{{ $errors->first('gender') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス<span>必須</span></th>
                        <td>
                            <input type="text" name="mail" value="{{ old('mail') }}" placeholder="例： xxx@xxx.com">
                            @if ($errors->has('mail'))
                                <span>{{ $errors->first('mail') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス確認<span>必須</span></th>
                        <td>
                            <input type="text" name="mail_confirm" value="" placeholder="例： xxx@xxx.com">
                            @if ($errors->has('mail_confirm'))
                                <span>{{ $errors->first('mail_confirm') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>電話番号<span>必須</span></th>
                        <td>
                            <p id="register_form_tel1">
                                <input type="text" name="tel1" value="{{ old('tel1') }}" maxlength="5" placeholder="000"> -
                                <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="5" placeholder="0000"> -
                                <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="5" placeholder="0000">
                            </p>
                            @if ($errors->has('tel1'))
                                <span>{{ $errors->first('tel1') }}</span>
                            @endif
                            @if ($errors->has('tel2'))
                                <span>{{ $errors->first('tel2') }}</span>
                            @endif
                            @if ($errors->has('tel3'))
                                <span>{{ $errors->first('tel3') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>郵便番号<span>必須</span></th>
                        <td>
                            <p id="register_form_post1">
                                <input type="text" name="postal_code1" value="{{ old('postal_code1') }}" maxlength="3" placeholder="000"> -
                                <input type="text" name="postal_code2" value="{{ old('postal_code2') }}" maxlength="4" placeholder="0000">
                            </p>
                            @if ($errors->has('postal_code1'))
                                <span>{{ $errors->first('postal_code1') }}</span>
                            @endif
                            @if ($errors->has('postal_code2'))
                                <span>{{ $errors->first('postal_code2') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>都道府県<span>必須</span></th>
                        <td>
                            <select name="pref">
                                @foreach (config('const.common.pref') as $key => $pref)
                                    <option value="{{ $key }}"{{ $key == old('pref') ? ' selected' : '' }}>{{ $pref }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('pref'))
                                <span>{{ $errors->first('pref') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>市区町村<span>必須</span></th>
                        <td>
                            <input type="text" name="city" class="address" value="{{ old('city') }}" placeholder="例： 千代田区">
                            @if ($errors->has('city'))
                                <span>{{ $errors->first('city') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>番地<span>必須</span></th>
                        <td>
                            <input type="text" name="address" class="address" value="{{ old('address') }}" placeholder="例： 五番町〇-〇">
                            @if ($errors->has('address'))
                                <span>{{ $errors->first('address') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>マンション名等</th>
                        <td><input type="text" name="other" class="address" value="{{ old('other') }}" placeholder="例： 〇〇マンション101号室"></td>
                    </tr>
                    <tr>
                        <th>備考</th>
                        <td>
                            <textarea name="memo" placeholder="他にお伝えしたい内容がございましたらご入力ください。">{{ old('memo') }}</textarea>
                            @if ($errors->has('memo'))
                                <span>{{ $errors->first('memo') }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
                <p class="register_form_submit"><input type="submit" name="conf" value="確認する"></p>
            </form>
        </div>
    </section>
@endsection
