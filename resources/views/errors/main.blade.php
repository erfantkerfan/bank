<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{ asset('fonts/vazir/font-face-FD.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-weight: 100;
            /*height: 100vh;*/
            height: auto;
            margin: 0;
            direction: rtl;
        }

        .full-height {
            margin-top: 60px;
            /*height: 95vh;*/
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 60px;
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
        .number{letter-spacing:-10px;line-height:128px;font-size:128px;font-weight:300}
        .font-red{display:inline-block;color:#ec8c8c;text-align:left}
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
