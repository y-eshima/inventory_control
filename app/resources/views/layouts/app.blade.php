<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name','在庫管理') }}</title>
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body>
    <header>
        <!-- ヘッダー -->
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- ヘッダーロゴ -->
                <div class="navbar-header">
                    <a href="#"><img src="{{ asset('images/logo.png') }}" class="w-25"></a>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer>

    </footer>
    </body>
</html>