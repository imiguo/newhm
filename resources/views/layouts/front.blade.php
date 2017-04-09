<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') {{ config('app.name', 'Laravel') }} @show</title>

    <!-- Styles -->
    <link href="{{ mix('front/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <style>
        html, body {
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        body {
            background-color: #f5f8fa;
            padding-top: 100px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            margin-top: 150px;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .flash-notification {
            position: absolute;
            top: 80px;
        }
        .panel {
            background: #ffffff;
            border-top: 5px solid #6b15a1;
            width: 100%;
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }
        .btn {
            border: 1px solid #6b15a1;
            background: #6b15a1;
            font-size: 14px;
            padding: 7px 24px;
            border-radius: 4px;
            color: #fff;
        }
        @yield('styles')
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @if (Route::has('login'))
            <div class="top-right links">
                <a href="{{ url('/') }}">Home</a>
                @if (Auth::check())
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                @endif
                <a href="{{ url('/index') }}">Index</a>
                <a href="{{ url('/rules') }}">Rules</a>
                <a href="{{ url('/faq') }}">Faq</a>
                <a href="{{ url('/aboutus') }}">Aboutus</a>
                <a href="{{ url('/howtoinvest') }}">Howtoinvest</a>
                <a href="{{ url('/support') }}">Support</a>
            </div>
        @endif

        <div class="container">
            <div class="flash-notification">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('front/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
