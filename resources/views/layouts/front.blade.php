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

        .swag-line:before {
            content: '';
            position: absolute;
            display: block;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            z-index: 2000;
            background-color: #ac2aa1;
            background: -webkit-linear-gradient(45deg, #6b15a1, #ac2aa1);
            background: linear-gradient(45deg, #6b15a1, #ac2aa1);
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
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .flash-notification {
            top: 80px;
            position: inherit;
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
        .box-title {
            margin-top: 0;
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
    <div id="app" class="swag-line">
        @if (Route::has('login'))
            <div class="top-right links">
                <a href="{{ url('/') }}">Home</a>
                @if (Auth::check())
                    @if (Auth::user()->is_admin)
                        <a href="{{ url('/admin') }}">Admin</a>
                    @endif
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
                <a href="{{ url('/rules') }}">Rules</a>
                <a href="{{ url('/faq') }}">Faq</a>
                <a href="{{ url('/aboutus') }}">Aboutus</a>
                <a href="{{ url('/howtoinvest') }}">Howtoinvest</a>
                <a href="{{ url('/support') }}">Support</a>
            </div>
        @endif

        <div class="container">
            <div class="flash-notification col-md-8 col-md-offset-2">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
            @yield('content')
            @if (Auth::check())
            <div class="content links" style="margin-top: 0">
                <a href="/account/summary">Account Summary</a>
                <a href="/deposit">Make Deposit</a>
                <a href="/withdraw">Withdraw</a>
                <a href="/history/deposits">Deposits History</a>
                <a href="/history/earnings">Earnings History</a>
                <a href="/history/referrals">Referrals History</a>
                <a href="/history/withdrawals">Withdrawals History</a>
                <a href="/referrals">Your Referrals</a>
                <a href="/account/link">Referral Links</a>
                <a href="/account/edit">Edit Personal Account</a>
            </div>
            @endif
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('front/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
