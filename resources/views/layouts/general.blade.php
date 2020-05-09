<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>@yield("title")</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticy-top navbar-light" style="background-color: white;">
        <div class="collapse navbar-collapse" id="navnav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link icon-header"><i class="fas fa-bolt"></i></a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a href="/products/create" class="nav-link push-product-link" style: "color: #666666;">出品</a>
                    </li>
                    <li class="nav-item">
                        <a href="/products" class="nav-link product-index-link" style: "color: #666666;">商品一覧</a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link logout-link" style: "color: #666666;">ログアウト</a>
                    </li>
                @else

                    <li class="nav-item">
                        <a href="/products" class="nav-link else-product-index-link" style: "color: #666666;">商品一覧</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link signup-link" style: "color: #666666;">ユーザー登録</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="nav-link signin-link" style: "color: #666666;">ログイン</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    @yield("content")
</body>
</html>
