<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style type="text/css">
            @font-face {
                font-family:'Font';
                src: url( {{asset('fonts/'.config('app.font'))}} );
            }

            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: black;
                color: white;
                text-align: center;
            }


            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }


            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
            }
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

            /*.m-b-md {*/
                /*margin-bottom: 30px;*/
            /*}*/
        </style>
    </head>
    <body style="font-family:'Font'">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">{{Auth::user()->username}}</a>
                    @else
                        <a href="{{ route('login') }}">ورود</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <h2>
                        صندوق قرض الحسنه قائم
                        <br>
                        <br>
                    </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-lg-7">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="/img/ghaem.jpg" alt="GHAEM">
                            <div class="carousel-caption d-none d-md-block">
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-5 panel panel-primary text-center">
                <div class="panel-heading">اعلان های عمومی</div>
                @forelse (\App\Notification::all() as $notification)
                    <div class="panel-body">{{ $notification->text }}</div>
                @empty
                    <div class="panel-body">اعلانی برای نمایش وجود ندارد</div>
                @endforelse
            </div>
        </div>

        <footer class="footer">
            <strong>
                طراحی توسط
                <a  href="http://t.me/er_gholizade" style="text-decoration:none">
                    © عرفان قلی زاده
                </a>
                2017
            </strong>
        </footer>

        <script src="/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="/js/popper.min.js" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>
