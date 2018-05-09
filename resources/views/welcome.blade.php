<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>
        <link rel="stylesheet" href="{{ asset('css/car-bootstrap.css') }}">
        <link rel="icon" href="/img/icon.gif" type="image/gif">

        <!-- Fonts -->
        <link href="{{ asset('css/googleapis.css') }}" rel="stylesheet" type="text/css">

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
            .title {
                font-size: 84px;
            }

        </style>
        {{--<script src="/js/jquery-3.2.1.slim.min.js"></script>--}}
        {{--<script src="/js/popper.min.js"></script>--}}
    </head>
    <body style="font-family:'Font'">
        <div class="flex-center">
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
                <div class="title">
                    <h2>
                        (صندوق قرض الحسنه حضرت قائم (عج
                        <br>
                        <br>
                    </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-7 col-sm-7">
                <div id="myCarousel" data-interval="2500" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($sliders as $slider)
                        <li data-target="#myCarousel" data-slide-to="{{$slider->id}}"></li>
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @forelse($sliders as $slider)
                            <div class="item {{ $loop->first ? ' active' : '' }}">
                                <img src="/img/slider/{{$slider->id}}.jpg" alt="{{$slider->nam}}" style="width:100%;">
                                <div class="carousel-caption" style="color: black">
                                    <h3>{{$slider->head}}</h3>
                                    <p>{{$slider->body}}</p>
                                </div>
                            </div>
                        @empty
                            <div class="item active">
                                <img src="/img/empty.jpg" alt="empty" style="width:100%;">
                            </div>
                        @endforelse
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">قبلی</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">بعدی</span>
                    </a>
                </div>
            </div>

            <div class="col-md-5 panel panel-primary text-center">
                <div class="panel-heading">اعلان های عمومی</div>
                @forelse (\App\Notification::all() as $notification)
                    <div class="panel-body">{!! nl2br(e($notification->text)) !!}</div>
                    <hr style="background-color:darkseagreen; height:2px;">
                @empty
                    <div class="panel-body">اعلانی برای نمایش وجود ندارد</div>
                @endforelse
            </div>
        </div>

        <footer class="footer">
            <strong>
                طراحی توسط
                <span class="glyphicon glyphicon-copyright-mark"></span>
                <a  href="http://t.me/er_gholizade" style="text-decoration:none">
                    عرفان قلی زاده
                </a>
                1397
            </strong>
        </footer>
    </body>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
