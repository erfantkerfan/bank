<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        @font-face {
            font-family:'Font';
            src: url( {{asset('fonts/'.config('app.font'))}} );
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 95vh;
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
<body style="font-family:'Font'">
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
                <a href="{{ url('/home') }}">بازگشت</a>
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            این صفحه وجود ندارد
        </div>
        <div class="number font-red"> 404 </div>
    </div>

</div>
</body>
</html>
