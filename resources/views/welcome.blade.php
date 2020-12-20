<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title dir="rtl">{{config('app.name')}}</title>
        <link rel="stylesheet" href="{{ asset('css/car-bootstrap.css') }}">
        <link rel="icon" href="/img/icon.webp" type="image/gif">
        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet'">
        <link href="{{ asset('fonts/vazir/font-face-FD.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet'">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet'">
        <style type="text/css">
            .bg {
                background: linear-gradient(158deg, rgba(84, 84, 84, 0.03) 0%, rgba(84, 84, 84, 0.03) 20%, rgba(219, 219, 219, 0.03) 20%, rgba(219, 219, 219, 0.03) 40%, rgba(54, 54, 54, 0.03) 40%, rgba(54, 54, 54, 0.03) 60%, rgba(99, 99, 99, 0.03) 60%, rgba(99, 99, 99, 0.03) 80%, rgba(92, 92, 92, 0.03) 80%, rgba(92, 92, 92, 0.03) 100%), linear-gradient(45deg, rgba(221, 221, 221, 0.02) 0%, rgba(221, 221, 221, 0.02) 14.286%, rgba(8, 8, 8, 0.02) 14.286%, rgba(8, 8, 8, 0.02) 28.572%, rgba(52, 52, 52, 0.02) 28.572%, rgba(52, 52, 52, 0.02) 42.858%, rgba(234, 234, 234, 0.02) 42.858%, rgba(234, 234, 234, 0.02) 57.144%, rgba(81, 81, 81, 0.02) 57.144%, rgba(81, 81, 81, 0.02) 71.42999999999999%, rgba(239, 239, 239, 0.02) 71.43%, rgba(239, 239, 239, 0.02) 85.71600000000001%, rgba(187, 187, 187, 0.02) 85.716%, rgba(187, 187, 187, 0.02) 100.002%), linear-gradient(109deg, rgba(33, 33, 33, 0.03) 0%, rgba(33, 33, 33, 0.03) 12.5%, rgba(147, 147, 147, 0.03) 12.5%, rgba(147, 147, 147, 0.03) 25%, rgba(131, 131, 131, 0.03) 25%, rgba(131, 131, 131, 0.03) 37.5%, rgba(151, 151, 151, 0.03) 37.5%, rgba(151, 151, 151, 0.03) 50%, rgba(211, 211, 211, 0.03) 50%, rgba(211, 211, 211, 0.03) 62.5%, rgba(39, 39, 39, 0.03) 62.5%, rgba(39, 39, 39, 0.03) 75%, rgba(55, 55, 55, 0.03) 75%, rgba(55, 55, 55, 0.03) 87.5%, rgba(82, 82, 82, 0.03) 87.5%, rgba(82, 82, 82, 0.03) 100%), linear-gradient(348deg, rgba(42, 42, 42, 0.02) 0%, rgba(42, 42, 42, 0.02) 20%, rgba(8, 8, 8, 0.02) 20%, rgba(8, 8, 8, 0.02) 40%, rgba(242, 242, 242, 0.02) 40%, rgba(242, 242, 242, 0.02) 60%, rgba(42, 42, 42, 0.02) 60%, rgba(42, 42, 42, 0.02) 80%, rgba(80, 80, 80, 0.02) 80%, rgba(80, 80, 80, 0.02) 100%), linear-gradient(120deg, rgba(106, 106, 106, 0.03) 0%, rgba(106, 106, 106, 0.03) 14.286%, rgba(67, 67, 67, 0.03) 14.286%, rgba(67, 67, 67, 0.03) 28.572%, rgba(134, 134, 134, 0.03) 28.572%, rgba(134, 134, 134, 0.03) 42.858%, rgba(19, 19, 19, 0.03) 42.858%, rgba(19, 19, 19, 0.03) 57.144%, rgba(101, 101, 101, 0.03) 57.144%, rgba(101, 101, 101, 0.03) 71.42999999999999%, rgba(205, 205, 205, 0.03) 71.43%, rgba(205, 205, 205, 0.03) 85.71600000000001%, rgba(53, 53, 53, 0.03) 85.716%, rgba(53, 53, 53, 0.03) 100.002%), linear-gradient(45deg, rgba(214, 214, 214, 0.03) 0%, rgba(214, 214, 214, 0.03) 16.667%, rgba(255, 255, 255, 0.03) 16.667%, rgba(255, 255, 255, 0.03) 33.334%, rgba(250, 250, 250, 0.03) 33.334%, rgba(250, 250, 250, 0.03) 50.001000000000005%, rgba(231, 231, 231, 0.03) 50.001%, rgba(231, 231, 231, 0.03) 66.668%, rgba(241, 241, 241, 0.03) 66.668%, rgba(241, 241, 241, 0.03) 83.33500000000001%, rgba(31, 31, 31, 0.03) 83.335%, rgba(31, 31, 31, 0.03) 100.002%), linear-gradient(59deg, rgba(224, 224, 224, 0.03) 0%, rgba(224, 224, 224, 0.03) 12.5%, rgba(97, 97, 97, 0.03) 12.5%, rgba(97, 97, 97, 0.03) 25%, rgba(143, 143, 143, 0.03) 25%, rgba(143, 143, 143, 0.03) 37.5%, rgba(110, 110, 110, 0.03) 37.5%, rgba(110, 110, 110, 0.03) 50%, rgba(34, 34, 34, 0.03) 50%, rgba(34, 34, 34, 0.03) 62.5%, rgba(155, 155, 155, 0.03) 62.5%, rgba(155, 155, 155, 0.03) 75%, rgba(249, 249, 249, 0.03) 75%, rgba(249, 249, 249, 0.03) 87.5%, rgba(179, 179, 179, 0.03) 87.5%, rgba(179, 179, 179, 0.03) 100%), linear-gradient(241deg, rgba(58, 58, 58, 0.02) 0%, rgba(58, 58, 58, 0.02) 25%, rgba(124, 124, 124, 0.02) 25%, rgba(124, 124, 124, 0.02) 50%, rgba(254, 254, 254, 0.02) 50%, rgba(254, 254, 254, 0.02) 75%, rgba(52, 52, 52, 0.02) 75%, rgba(52, 52, 52, 0.02) 100%), linear-gradient(90deg, #FFF, #FFF);
            }
            .fa {
                padding: 20px;
                font-size: 30px;
                width: 30px;
                text-align: center;
                text-decoration: none;
                margin: 10px 10px;
                border-radius: 50%;
            }
            .fa:hover {
                opacity: 0.7;
            }
            .fa-telegram {
                background: white;
                color: #55ACEE;
            }
            .fa-twitter {
                background: white;
                color: #55ACEE;
            }
            .fa-yahoo {
                background: white;
                color: #430297;
            }
            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background: grey;
                color: white;
                text-align: center;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .links > a {
                font-weight: 900;
                color: #ffffff;
                text-decoration: none;
            }
            .title {
                font-size: 84px;
            }

        </style>
        {{--<script src="/js/jquery-3.2.1.slim.min.js"></script>--}}
        {{--<script src="/js/popper.min.js"></script>--}}
    </head>
    <body class="bg">
    <div class="container">

        <div>
            @auth
                <a class="float-right mt-4 btn btn-primary links" href="{{ route('home') }}">{{Auth::user()->username}}</a>
            @else
                <a class="float-right mt-4 btn btn-primary links" href="{{ route('login') }}">ورود اعضا</a>
            @endauth
        </div>

        <div>
            <button type="button" class="float-right mt-4 btn btn-success" data-toggle="modal" data-target="#San" style="margin: 1%">
                تماس با ما
            </button>
        </div>

        <div>
            <button type="button" class="float-right mt-4 btn btn-success" data-toggle="modal" data-target="#Law">
                قوانین و مقررات
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Law" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">قوانین و مقررات صندوق</h4>
                    </div>
                    <div class="modal-body" dir="rtl">
                        <h4 class="text-center" style="color:#0056b3">
                            <a href="https://san-ghaem.sbu.ac.ir/اساسنامه صندوق قائم نهایی سال 98.pdf" style="color: inherit;">
                                دانلود اساسنامه صندوق قائم نهایی سال 98
                            </a>
                            <br>
                            <br>
                        </h4>
                        @foreach($config_laws as $law)
                            <h4 class="text-center" style="color:#0056b3">
                                {!! nl2br(e(Str::before($law->text,','))) !!}
                            </h4>
                            <p class="text-right">
                                {!! nl2br(e(Str::after($law->text,','))) !!}
                            </p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="San" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">تماس با ما</h4>
                    </div>
                    <div class="modal-body text-center" dir="rtl">
                        <p>
                            {!! nl2br(e($config_top->text)) !!}
                            <br>
                            ساعات کاری صندوق:
                            <table class="table" dir="rtl">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">روز هفته</th>
                                    <th scope="col" class="text-center">شروع زمان</th>
                                    <th scope="col" class="text-center">پایان زمان</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($config_hours as $hour)
                                    <tr>
                                        <td>{{Str::before($hour->text,',')}}</td>
                                        <td>{{Str::before(Str::after($hour->text,','),',')}}</td>
                                        <td>{{Str::after(Str::after($hour->text,','),',')}}</td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                            {!! nl2br(e($config_down->text)) !!}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="flex-center">--}}
            <div class="text-center">
                <div class="title">
                    <h2 dir="rtl">
                        صندوق قرض الحسنه حضرت قائم (عج)
                        <img src="/img/brand.webp" width="10%">
                    </h2>
                </div>
            </div>
        {{--</div>--}}

        <div class="col-md-7">
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
                            <img id="image" src="/img/slider/{{$slider->id}}.jpg" alt="{{$slider->nam}}" style="width: 100%;height: 400px" onerror="this.src='/img/empty.webp';">
                            <div class="carousel-caption" style="color: black">
                                <h3>{{$slider->head}}</h3>
                                <p>{{$slider->body}}</p>
                            </div>
                        </div>
                    @empty
                        <div class="item active">
                            <img src="/img/empty.webp" alt="empty" style="width:100%;">
                        </div>
                    @endforelse
                </div>
                <script>
                    var img = document.getElementById('image');
                    var width = img.clientWidth;
                    document.getElementById("image").style.height = width*0.3;
                </script>

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
            <div class="text-center">
                {{--<script src="https://cdn.zarinpal.com/trustlogo/v1/trustlogo.js" type="text/javascript"></script>--}}
                <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
            </div>
        </div>

        <div class="col-md-5 panel panel-primary text-center">
            <div class="panel-heading">اعلان های عمومی</div>
            @forelse ($notifications as $notification)
                <div dir="rtl" class="panel-body">{!! nl2br(e($notification->text)) !!}</div>
                <hr style="background-color:darkseagreen; height:2px;">
            @empty
                <div class="panel-body">اعلانی برای نمایش وجود ندارد</div>
            @endforelse
        </div>

        <footer class="footer">
            <strong>
                طراحی توسط
                <span class="glyphicon glyphicon-copyright-mark"></span>
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Erfan_Gholizade">عرفان قلی زاده</button>
                1397
            </strong>
        </footer>

        <!-- Modal -->
        <div class="modal fade" id="Erfan_Gholizade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">تماس با من</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        <span class="fa fa-telegram"></span>
                        <a style="text-decoration: none" href="https://t.me/erfantkerfan">تلگرام</a>
                        t.me/erfantkerfan
                        </p>

{{--                        <p>--}}
{{--                        <span class="fa fa-twitter"></span>--}}
{{--                        <a style="text-decoration: none" href="https://twitter.com/erfantkerfan">توییتر</a>--}}
{{--                        twitter.com/erfantkerfan--}}
{{--                        </p>--}}

                        <p>
                        <span class="fa fa-yahoo"></span>
                        <a style="text-decoration: none" href="mailto:erfantkerfan@yahoo.com?subject=طراحی سایت">ایمیل</a>
                        erfantkerfan@yahoo.com
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </body>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
