<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title dir="rtl">{{config('app.name')}}</title>
        <link rel="stylesheet" href="{{ asset('css/car-bootstrap.css') }}">
        <link rel="icon" href="/img/icon.gif" type="image/gif">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <!-- Fonts -->
        <link href="{{ asset('css/googleapis.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style type="text/css">
            @font-face {
                font-family:'Font';
                src: url( {{asset('fonts/'.config('app.font'))}} );
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
    <body style="font-family:'Font'">
    <div class="container">

        <div>
            {{--<button type="button">--}}
                {{--<span class="links">--}}
                    @auth
                        <a class="float-right mt-4 btn btn-primary links" href="{{ route('home') }}">{{Auth::user()->username}}</a>
                    @else
                        <a class="float-right mt-4 btn btn-primary links" href="{{ route('login') }}">ورود اعضا</a>
                    @endauth
                {{--</span>--}}
            {{--</button>--}}
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
                    <div style="font-family:'Font'" class="modal-body" dir="rtl">
                        <h4 class="text-center" style="color:#0056b3">
                            <a href="https://san-ghaem.sbu.ac.ir/اساسنامه صندوق قائم نهایی سال 98.pdf" style="color: inherit;">
                                دانلود اساسنامه صندوق قائم نهایی سال 98
                            </a>
                            <br>
                            <br>
                        </h4>
                        @foreach($config_laws as $law)
                            <h4 class="text-center" style="color:#0056b3">
                                {!! nl2br(e(str_before($law->text,','))) !!}
                            </h4>
                            <p class="text-right">
                                {!! nl2br(e(str_after($law->text,','))) !!}
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
                    <div style="font-family:'Font'" class="modal-body text-center" dir="rtl">
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
                                        <td>{{str_before($hour->text,',')}}</td>
                                        <td>{{str_before(str_after($hour->text,','),',')}}</td>
                                        <td>{{str_after(str_after($hour->text,','),',')}}</td>
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
                        <img src="/img/brand.gif" width="10%">
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
                            <img id="image" src="/img/slider/{{$slider->id}}.jpg" alt="{{$slider->nam}}" style="width: 100%;height: 400px">
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
                    <div style="font-family:'Font'" class="modal-body">
                        <p>
                        <span class="fa fa-telegram"></span>
                        <a style="text-decoration: none" href="https://t.me/erfantkerfan">تلگرام</a>
                        t.me/erfantkerfan
                        </p>

                        <p>
                        <span class="fa fa-twitter"></span>
                        <a style="text-decoration: none" href="https://twitter.com/erfantkerfan">توییتر</a>
                        twitter.com/erfantkerfan
                        </p>

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
