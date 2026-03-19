<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header_inner">
            <div class="header-utilities">
                <a class="header_logo" href="/">
                    coachtech
                </a>
                <nav>
                    <ul class="header-nav">
                        @if (Auth::check())
                        <li class="header-nav_item">
                            <form action="">
                                <input class="search_form" type="text">
                            </form>
                        </li>
                        <li class="header-nav_item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav_button">ログアウト</button>
                            </form>
                        </li>
                        <li class="header-nav_item">
                            <form action="">
                                <button class="header-nav_button">マイページ</button>
                            </form>
                        </li>
                        <li class="header-nav_item">
                            <a class="header-nav_link" href="">出品</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>


