<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>HuwaHuwaのカシミアセーター</title>
    <meta name="description" content="重量感たっぷりの本物のミンクとカシミアの毛を使用!!フワフワだけど高級感のあるミンクとカシミアのセーター">
    <meta name="keywords" content="カシミア,セーター,ミンク,ふわふわ,高級カシミア,ミンクカシミア">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"">
</head>
<body>
    <div class="container">
        <header>
            <div class="header_left">
                <a href="{{ route('index') }}"><img src="{{ asset('images/logo.png') }}" class="loginform_logo"></a>
            </div>
            <div class="header_right">
                @auth
                    <p class="header_txt">ユーザー：{{ Auth::user()->name }}</p>
                    <a href="" class="header_link header_link_3">カートをみる</a>
                    <a href="{{ route('logout') }}" class="header_link header_link_2">ログアウト</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="header_link header_link_1">ログイン</a>
                    <a href="{{ route('new_account_edit') }}" class="header_link header_link_2">会員登録</a>
                @endguest
            </div>
        </header>
        @yield('content')
        <footer>
            <img src="{{ asset('images/shop_information.jpg') }}" alt="HUWAHUWA">
            <small>Copyright&copy;HuwaHuwa all rights reserved.</small>
        </footer>
    </div>
    <script type="text/javascript" src="js/getaddress.js"></script>
</body>

</html>
