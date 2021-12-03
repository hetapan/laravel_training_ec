@extends('template')
@section('content')
    <section class="login_form">
        <h2 class="login_title">ログイン画面</h2>
        <p class="login_txt">ログインIDとパスワードを入力してログインしてください。</p>
        <div class="login_form_panel">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            @endif
            <form action="{{ url('login') }}" method="post">
                {{ csrf_field() }}
                <label class="login_form_label">ログインID</label>
                <input type="text" class="login_form_item" name="login_id" value="{{ old('login_id') }}">
                <label class="login_form_label">パスワード</label>
                <input type="password" class="login_form_item" name="password">
                <p class="login_form_submit"><input type="submit" name="login_btn" value="ログイン"></p>
            </form>
         </div>
    </section>
@endsection
