<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>HuwaHuwaのカシミアセーター</title>
    <meta name="description" content="重量感たっぷりの本物のミンクとカシミアの毛を使用!!フワフワだけど高級感のあるミンクとカシミアのセーター">
    <meta name="keywords" content="カシミア,セーター,ミンク,ふわふわ,高級カシミア,ミンクカシミア">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}"">
</head>
<body class="admin_html">
    <div class="container">
        @auth('admin')
            <header class="admin_header">
                <div class="admin_header_top">
                    <div class="admin_header_left">
                        <p>ログイン名[{{ Auth::guard('admin')->user()->name }}]さん、ご機嫌いかがですか？</p>
                    </div>
                    <div class="admin_header_right">
                        <p><a href="{{ route('admin_logout') }}" class="admin_header_link">ログアウトする</a></p>
                    </div>
                </div>
                <h2 class="admin_header_title">HuwaHuwaのカシミアセーター　管理画面</h2>
                <nav class="admin_nav">
                    <ul>
                        <li><a href="{{ route('admin_top') }}">top</a></li>
                        <li><a href="{{ route('admin_product_list')}}">商品管理</a></li>
                    </ul>
                </nav>
            </header>
        @endauth
        @yield('content')
        <footer class="admin_footer">
            <small>2021 ebacorp.inc</small>
        </footer>
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
