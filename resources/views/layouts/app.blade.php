<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        @font-face {
            font-family:'Font';
            src: url( {{asset('fonts/'.config('app.font'))}} );
        }
        body, html {
            height: 100%;
            margin: 0;
        }
        /*TODO background*/
        .bg {
            /* The image used */
            background-image: url("/img/bg.png");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
        }
    </style>

</head>
<body style="font-family:'Font'" class="bg">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top ">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">ورود</a></li>
                        @else
                            @if (Auth::user()->is_admin==1)
                                <li><a href="{{ Storage::url('public/Mysql_Backup_Ghaem.sql') }}" onclick="return confirm('آیا از دانلود دیتابیس اطمینان دارید؟')" >دانلود دیتابیس</a></li>

                                <li><a href="{{ route('register') }}">ثبت نام</a></li>
                                <li><a href="{{ route('notification') }}">اعلان ها</a></li>

                                <li><a href="{{ route('notes') }}">
                                        <div class="badge">
                                            {{ App\User::where('note','!=',null)->count() }}
                                        </div>
                                        یادداشت مدیریت
                                    </a>
                                </li>

                                <li><a href="{{ route('not_proved') }}">
                                        <div class="badge">
                                            {{App\Payment::where('is_proved','=','0')->count('payment')
                                            +App\Loan::where('is_proved','=','0')->count('Loan')}}
                                        </div>
                                        تایید تراکنش ها
                                    </a>
                                </li>

                                <li><a href="{{ route('admin') }}">صفحه مدیریت</a></li>
                            @endif


                            <li> <a href="{{ route('home') }}">تراکنش ها</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="text-center">

                                            <a href="#">{{str_before(\Hekmatinasser\Verta\Verta::now(),' ')}}</a>

                                        <a href="#"><img src="/img/ip.png" height="25">{{Request::getClientIp()}}</a>

                                        <a style="color: red" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                            <img src="/img/exit.png" height="23">
                                            خروج
                                                </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        </form>

                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</div>
</body>
</html>
