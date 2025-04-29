<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name','在庫管理') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body>
    <header>
        <!-- ヘッダー -->
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- ヘッダーロゴ -->
                <div class="navbar-header">
                    <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" class="w-25"></a>
                </div>
                <!-- 社員名と店舗名を表示 -->
                <div class="d-flex align-item-center gap-4">
                    <ul class="list-unstyled">
                        <li class="h5">{{ $user->name }}</li>
                        <li class="h5">{{ $user->store->name }}</li>
                    </ul>
                </div>
                <!-- ログアウトボタン -->
                <div class="d-flex align-item-center">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-primary btn-lg">ログアウト</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer>

    </footer>
    </body>
</html>