@extends('template')
@section('content')
<section class="register_conf">
    <div class="register_conf_panel">
        <h2 class="register_conf_title">会員登録完了</h2>
        <h3 class="register_conf_txt1">会員登録ありがとうございます。</h3>
        <p class="register_conf_txt2">ご登録のメールアドレスへご確認のメールをお送り致しました。<br>ご登録内容が正しいかご確認ください。</p>
        <p class="register_conf_txt2">※万が一メールが届かない場合は03-5912-6155にお問い合わせください</p>
        <a href="{{ route('my_page') }}" class="register_conf_btn">マイページへ</a>
    </div>
</section>
@endsection