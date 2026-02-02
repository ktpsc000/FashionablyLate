<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
</head>


<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="{{ url('/') }}">FashionablyLate</a>

            @if (!request()->routeIs('contact.*'))
            <nav class="header__nav">
                <ul class="header__nav--list">
                    @if (request()->routeIs('auth.login'))
                    <li class="header__nav--item"><a href="{{ url('/register') }}">register</a></li>
                    @endif
                    @if (request()->routeIs('auth.register'))
                    <li class="header__nav--item"><a href="{{ url('/login') }}">login</a></li>
                    @endif

                    @if (Auth::check() && !request()->routeIs('auth.*'))
                    <li class="header__nav--item">
                        <form class="form__logout" action="/logout" method="post">
                            @csrf
                            <button type="submit" class="form__logout--button">logout</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>


</html>