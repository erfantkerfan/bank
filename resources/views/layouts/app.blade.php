<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/icon.webp" type="image/gif">
    <title dir="rtl">{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{ asset('fonts/vazir/font-face-FD.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet'">
    @yield('head')
</head>
<body class="bg">
    <nav class="navbar navbar-default navbar-inverse sticky-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a dir="rtl" class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse" style="direction: rtl; max-height: fit-content">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('login') }}">ورود</a></li>
                    @else
                        @if (Auth::user()->is_admin==1)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    ابزارها <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu">

                                <li class="text-center">

                                    <a href="{{ route('notification') }}">اعلان ها</a>

                                    <a href="{{ route('config') }}">تماس با ما و قوانین</a>

                                    <a href="{{ route('slider') }}">اسلایدر</a>

                                    <a href="{{ route('expense') }}">هزینه های صندوق</a>

                                    <a href="{{ route('register') }}">ثبت اطلاعات عضو</a>

                                    <a href="{{ route('unverified') }}" onclick="return confirm(
                                        'فرآیند به طور اتوماتیک هر ساعت انجام میشود، دستی انجام شود؟' +
                                         '    تا حد امکان دستی انجام نشود'
                                    )">تایید تراکنش های زرین پال</a>

                                    <a href="{{ route('database') }}" onclick="return confirm('آیا از دانلود دیتابیس اطمینان دارید؟')" >
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        دانلود دیتابیس
                                    </a>

                                </li>
                            </ul>

                            <li>
                                <a href="{{ route('request') }}">
                                    <div class="badge">
                                        {{App\Request::where('is_proved','=','0')->count()}}
                                    </div>
                                    درخواست های رسمی
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('notes') }}">
                                    <div class="badge">
                                        {{App\User::where('note','!=',null)->count()+App\User::where('user_note','!=',null)->count()}}
                                    </div>
                                    پیام ها
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    اقساط فعال <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">

                                    <li class="text-center">

                                        <a href="{{ route('normal_instalments') }}">
                                            <div class="badge">
                                                {{App\User::where('instalment','!=',null)->count()}}
                                            </div>
                                            عادی
                                        </a>

                                        <a href="{{ route('force_instalments') }}">
                                            <div class="badge">
                                                {{App\User::where('instalment_force','!=',null)->count()}}
                                            </div>
                                            ضروری
                                        </a>

                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    تایید تراکنش ها <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">

                                    <li class="text-center">

                                        <a href="{{ route('unproved1') }}">
                                            <div class="badge">
                                                {{App\Payment::where('is_proved','=','0')->count()}}
                                            </div>
                                            پرداخت ها
                                        </a>

                                        <a href="{{ route('unproved2') }}">
                                            <div class="badge">
                                                {{App\Loan::where('is_proved','=','0')->count()}}
                                            </div>
                                            قرض الحسنه ها
                                        </a>

                                        <a href="{{ route('unproved3') }}">
                                            <div class="badge">
                                                {{App\Onlinepayment::with('payment')
                                                ->whereHas('payment', function($query)
                                                {
                                                    $query->whereNull('delay');
                                                })->count()}}
                                            </div>
                                            امتیاز پرداخت به موقع آنلاین
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    صفحه مدیریت<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="text-center">

                                        <a href="{{ route('admin') }}">مدیریت کاربران</a>

                                        <a href="{{ route('admin_transaction') }}">مدیریت خلاصه تراکنش ها</a>

                                        <a href="{{ route('loan_report') }}">گزارش وام های اعطایی</a>

                                    </li>
                                </ul>
                            </li>

                            <li></li>
                        @endif


                        <li> <a href="{{ route('home') }}">تراکنش ها</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="text-center">

                                    <a href="#">{{Str::before(Verta::now(),' ')}}:امروز<span class="glyphicon glyphicon-time"></span></a>

                                    <a href="#">{{Request::getClientIp()}}:IP<span class="glyphicon glyphicon-map-marker"></span></a>

                                    <a href="{{route('setpassword_form')}}" style="color: green">تغییر رمز عبور</a>

                                    <a style="color: red" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        خروج
                                        <span class="glyphicon glyphicon-log-out"></span>
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
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('js/autoNumeric-1.9.18.js') }}"></script>
        <script type='text/javascript'>
            $(function($) {
                $('#payment').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });
            $(function($) {
                $('#loan_payment').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });
            $(function($) {
                $('#loan_payment_force').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });
            $(function($) {
                $('#payment_cost').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });
            $(function($) {
                $('#loan').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });
            $(function($) {
                $('#expense').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });
            $(function($) {
                $('#fee').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
            });

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js')

</body>
</html>
