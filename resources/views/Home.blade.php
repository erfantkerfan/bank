@extends('layouts.app')

@section('content')
    <script>
        function numberWithCommas() {
            var1 = parseInt(document.getElementById('payment').value.replace(/,/g, ''))||0 ;
            if(document.getElementById("negative")){
                if(document.getElementById('negative').checked){
                    var1 = -var1
                }
            }
            var2 = parseInt(document.getElementById('loan_payment').value.replace(/,/g, ''))||0 ;
            var3 = parseInt(document.getElementById('loan_payment_force').value.replace(/,/g, ''))||0 ;
            var4 = parseInt(document.getElementById('payment_cost').value.replace(/,/g, ''))||0 ;
            x = var1 + var2 + var3 + var4
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1,$2");
            return x;
        }
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <div class="container-fluid text-center">
        <div class="row">

            <div dir="rtl" class="text-center">
                @if($permission==1 && isset($previous_user))
                    <a href="{{route('user',['id'=>$previous_user])}}"><button type="button" class="btn btn-sm btn-primary" dir="rtl">عضو قبلی</button></a>
                                
                @endif
                حساب قرض الحسنه
                @if($permission==1)
                    <a href="{{ route('user_edit',['id'=>$user->id]) }}">{{$user->f_name.' '.$user->l_name}}</a>
                @elseif($permission==0)
                    {{$user->f_name.' '.$user->l_name}}
                @endif
                <span class="glyphicon glyphicon glyphicon-minus"></span>
                شماره حساب:
                {{$user->acc_id}}
                <span class="glyphicon glyphicon glyphicon-minus"></span>
                آخرین ورود:
                {{str_replace(' ','   ',str_replace('-','/',$user->old_login))}}
                @if($permission==1 && isset($next_user))
                                   
                    <a href="{{ route('user',['id'=>$next_user]) }}"><button type="button" class="btn btn-sm btn-primary" dir="rtl">عضو بعدی</button></a>
                @endif
            </div>
            <br>

            <div class="col-md-4">
                @if (!is_null($user->instalment_force))
                    <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            <span class="glyphicon glyphicon-remove-sign"></span>
                        </a>
                        مبلغ اقساط قابل پرداخت (ضروری):
                        <strong> {{number_format($user->instalment_force)}} </strong>
                        <br>
                        تاریخ شروع اقساط:
                        <strong> {{$user->start_date_force}} </strong>
                        <br>
                        تاریخ پایان اقساط:
                        <strong> {{$user->end_date_force}} </strong>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                @if (!is_null($user->instalment))
                    <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            <span class="glyphicon glyphicon-remove-sign"></span>
                        </a>
                        مبلغ اقساط قابل پرداخت (عادی):
                        <strong> {{number_format($user->instalment)}} </strong>
                        <br>
                        تاریخ شروع اقساط:
                        <strong> {{$user->start_date}} </strong>
                        <br>
                        تاریخ پایان اقساط:
                        <strong> {{$user->end_date}} </strong>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                @if (!is_null($user->note))
                    <div dir="rtl" class="alert alert-info alert-dismissible text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            <span class="glyphicon glyphicon-remove-sign"></span>
                        </a>
                        <span style="color:rgb(65, 150, 19)">
                            پیام مدیریت صندوق برای شما در تاریخ
                            {{str_replace(' ','   ',str_replace('-','/',$user->note_date))}}
                        </span>
                        <br>
                        <strong> {!! nl2br(e($user->note)) !!} </strong>
                    </div>
                @endif
            </div>
        </div>

        @if($user->active==1)
        <div class="col-md-5">
            <div class="panel panel-primary">

                <a data-toggle="collapse" href="#collapse1">
                    <div class="panel-heading">درج پرداخت</div>
                </a>

                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body bg-success">
                        <form class="form" method="POST" action="{{ route('payment_create') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                                <label for="payment" class="control-label">:افزایش سرمایه</label>
                                <div class="col-md-7">
                                    <input id="payment" type="text" class="form-control" name="payment" value="{{ old('payment') }}" placeholder="صفر یا مبلغ به ریال" required autofocus>

                                    @if ($errors->has('payment'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('payment') }}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('loan_payment') ? ' has-error' : '' }}">
                                <label for="loan_payment" class="control-label">:اقساط قرض الحسنه عادی</label>
                                <div class="col-md-7">
                                    <input id="loan_payment" type="text" class="form-control" name="loan_payment" value="{{ old('loan_payment') }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('loan_payment'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('loan_payment') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan_payment_force') ? ' has-error' : '' }}">
                                <label for="loan_payment_force" class="control-label">:اقساط قرض الحسنه ضروری</label>
                                <div class="col-md-7">
                                    <input id="loan_payment_force" type="text" class="form-control" name="loan_payment_force" value="{{ old('loan_payment_force') }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('loan_payment_force'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('loan_payment_force') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_cost') ? ' has-error' : '' }}">
                                <label for="payment_cost" class="control-label">: هزینه های صندوق</label>
                                <div class="col-md-7">
                                    <input id="payment_cost" type="text" class="form-control" name="payment_cost" value="{{ old('payment_cost') }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('payment_cost'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('payment_cost') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="control-label">:توضیحات</label>
                                <div class="col-md-7">
                                    <input id="description" dir="rtl" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="میتواند خالی باشد" autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            @if($permission==1)
                                <div class="form-group{{ $errors->has('is_proved') ? ' has-error' : '' }}">
                                    <label for="is_proved" class="control-label">:تایید شدن مدیریت</label>
                                    <div class="col-md-7">
                                        <label class="radio-inline"><input type="radio" name="is_proved" value="0">خیر</label>
                                        <label class="radio-inline"><input type="radio" name="is_proved" value="1" checked>بله</label>

                                        @if ($errors->has('is_proved'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('is_proved') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            @endif


                            <div class="form-group">
                                <div>
                                    <span class="col-md-8 col-md-offset-1">
                                    <button name="online_payment" value="0" type="submit" class="btn btn-primary"
                                            onclick="return confirm
                                            (' مجموع مبلغ پرداختی صحیح است؟ ' +
                                            numberWithCommas()+
                                            ' ریال '
                                            )">
                                        ثبت پرداخت
                                    </button>

                                    <button name="online_payment" value="1" type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                        پرداخت اینترنتی
                                    </button>
                                    </span>

                                    @if($permission==1)
                                        <div class="checkbox col-md-3">
                                            <label><input  name="negative" id="negative" type="checkbox" value="1">کسر از سرمایه</label>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
                <a data-toggle="collapse" href="#collapse2">
                    <div class="panel-heading text-center">درج درخواست های رسمی</div>
                </a>

                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body bg-success">
                        <form class="form" method="POST" action="{{ route('loan_create') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('loan') ? ' has-error' : '' }}">
                                <label for="loan" class="control-label">
                                    :
                                    مبلغ قرض الحسنه
                                </label>
                                <div class="col-md-7">
                                    <input id="loan" type="text" class="form-control" name="loan" value="{{ old('loan') }}" required placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('loan'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('loan') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('request_date') ? ' has-error' : '' }}">
                                <label for="request_date" class="control-label">
                                    :
                                    تاریخ مورد نیاز قرض الحسنه
                                </label>
                                <div class="col-md-7">
                                    <input id="request_date" type="text" class="form-control" name="request_date" value="{{ old('request_date') }}" required autofocus>

                                    @if ($errors->has('request_date'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('request_date') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('force') ? ' has-error' : '' }}">
                                <label for="force" class="control-label">:نوع قرض الحسنه</label>
                                <div class="col-md-7">
                                    <label class="radio-inline"><input type="radio" name="force" value="0" checked>عادی</label>
                                    <label class="radio-inline"><input type="radio" name="force" value="1">ضروری</label>

                                    @if ($errors->has('force'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('force') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                        @if($permission==1)
                            <div class="form-group{{ $errors->has('is_proved') ? ' has-error' : '' }}">
                                <label for="is_proved" class="control-label">:تایید شدن مدیریت</label>
                                <div class="col-md-7">
                                    <label class="radio-inline"><input type="radio" name="is_proved" value="0">خیر</label>
                                    <label class="radio-inline"><input type="radio" name="is_proved" value="1" checked>بله</label>

                                    @if ($errors->has('is_proved'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('is_proved') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                            <div dir="rtl">
                                 متن درخواست:
                                <br>
                                اینجانب
                                {{$user->f_name.' '.$user->l_name}}
                                در تاریخ فوق و به مبلغ مزبور درخواست قرض الحسنه از نوع مشخص شده را دارم.
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="control-label">:سایر توضیحات</label>
                                <div class="col-md-7">
                                    <input id="description" dir="rtl" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="میتواند خالی باشد" autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت درخواست قرض الحسنه
                                    </button>
                                </div>
                            </div>

                            <div dir="rtl">
                                سایر درخوست های رسمی:
                            </div>
                            <br>

                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#withdraw_panel">
                                برداشت از سرمایه
                            </button>

                            <button type="button" class="btn btn-sm btn-outline-primary btn-danger" data-toggle="modal" data-target="#close_panel">
                                بستن حساب و تسویه
                            </button>

                        </form>

                        <!-- Modal -->
                        <div class="modal fade" id="withdraw_panel" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">برداشت موجودی از حساب</h4>
                                    </div>

                                    <div style="font-family:'Font'" class="modal-body">
                                        <form class="form" method="POST" action="{{ route('request_create') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
                                                <label for="fee" class="control-label">
                                                    :
                                                    مبلغ برداشتی
                                                </label>
                                                <div class="col-md-7">
                                                    <input id="fee" type="text" class="form-control" name="fee" value="{{ old('fee') }}" required placeholder="مبلغ به ریال" autofocus>

                                                    @if ($errors->has('fee'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('fee') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div dir="rtl">
                                                متن درخواست:
                                                <br>
                                                لطفا مبلغ مزبور از محل سرمایه اینجانب پرداخت نمایید.
                                            </div>
                                            <br>

                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                <label for="description" class="control-label">
                                                    :
                                                    توضیحات
                                                </label>
                                                <div class="col-md-7">
                                                    <input id="description" dir="rtl" type="text" class="form-control" name="description" autofocus>

                                                    @if ($errors->has('description'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <input id="type" type="hidden" class="form-control" name="type" value="-1">

                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-warning">
                                                        ثبت درخواست
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="close_panel" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">بستن حساب و تسویه</h4>
                                    </div>

                                    <div style="font-family:'Font'" class="modal-body">
                                        <form class="form" method="POST" action="{{ route('request_create') }}">
                                            {{ csrf_field() }}

                                            <div dir="rtl">
                                                متن درخواست:
                                                <br>
                                                لطفا حساب اینجانب بسته شود و تسویه حساب کامل صورت پذیرد.
                                            </div>
                                            <br>

                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                <label for="description" class="control-label">
                                                    :
                                                    توضیحات
                                                </label>
                                                <div class="col-md-7">
                                                    <input id="description" dir="rtl" type="text" class="form-control" name="description" placeholder="ورود توضیحات لازم است" required autofocus>

                                                    @if ($errors->has('description'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <input id="type" type="hidden" class="form-control" name="type" value="0">

                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-danger">
                                                        ثبت درخواست
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->

                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-3">
            <div class="panel panel-primary">
                <a data-toggle="collapse" href="#collapse3">
                    <div class="panel-heading text-center">درج پیام به مدیریت</div>
                </a>

                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body bg-success">
                        <form class="form" method="POST" action="{{ route('user_note') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('user_note') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <textarea dir="rtl" style="resize: vertical" class="form-control form-group" name="user_note" rows="7" autofocus>{{ $user->user_note }}</textarea>

                                    @if ($errors->has('user_note'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('user_note') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        ثبت پیام
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-12">

            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <a href="{{ route('full_pdf',['id'=>$user->id]) }}" style="text-decoration:none">
                        <button type="button" class="btn btn-sm btn-success" dir="rtl">
                            نسخه pdf تمام صفحات
                        </button>
                    </a>
                    خلاصه وضعیت با احتساب تراکنش های تایید شده
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">مجموع امتیاز پرداخت به موقع</th>
                            <th class="text-center">کل پرداخت بابت هزینه های صندوق</th>
                            <th class="text-center">کل بدهی</th>
                            <th class="text-center">کل قرض الحسنه ضروری دریافتی</th>
                            <th class="text-center">کل قرض الحسنه عادی دریافتی</th>
                            <th class="text-center">سرمایه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-warning">
                            <td class="text-center">{{$user->delays()}}</td>
                            <td class="text-center">{{number_format($summary->payments_cost)}}</td>
                            <td class="text-center">{{number_format($summary->debt_force+$summary->debt)}}
                            <td class="text-center">{{number_format($summary->loans_force_all)}}</td>
                            <td class="text-center">{{number_format($summary->loans_all)}}</td>
                            <td class="bg-success text-center">{{number_format($summary->payments)}}</td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">بدهی قرض الحسنه جاری ضروری</th>
                            <th class="text-center">قرض الحسنه جاری ضروری</th>
                            <th class="text-center">بدهی قرض الحسنه جاری عادی</th>
                            <th class="text-center">قرض الحسنه جاری عادی</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-warning">
                            <td class="bg-danger text-center">{{number_format($summary->debt_force)}}</td>
                            <td class="bg-danger text-center">
                                @if(is_int($summary->loan_force))
                                    {{number_format($summary->loan_force)}}
                                @else
                                    {{$summary->loan_force}}
                                @endif
                            </td>
                            <td class="text-center">{{number_format($summary->debt)}}</td>
                            <td class="text-center">
                                @if(is_int($summary->loan))
                                    {{number_format($summary->loan)}}
                                @else
                                    {{$summary->loan}}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    {{--<a href="{{ route('pdf',['id'=>$user->id,'mode'=>'payment','date'=>'all']) }}" style="text-decoration:none">--}}
                        {{--<button type="button" class="btn btn-sm btn-success" dir="rtl">--}}
                        {{--نسخه pdf--}}
                        {{--</button>--}}
                    {{--</a>--}}
                    پرداخت ها
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            @if($permission==1)
                                <th class="text-center">تایید پرداخت</th>
                                <th class="text-center">ویرایش پرداخت</th>
                            @endif
                            <th class="text-center">حذف پرداخت</th>
                            <th class="text-center">تایید توسط</th>
                            <th class="text-center"><a data-toggle="tooltip" title="امتیاز  پرداخت به موقع - منفی به معنای تاخیر است"><span class="glyphicon glyphicon-question-sign"></span></a>امتیاز</th>
                            <th class="text-center">توضیحات مدیر</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">سرمایه لحظه ای</th>
                            <th class="text-center">مجموع پرداختی</th>
                            <th class="text-center">پرداخت هزینه صندوق</th>
                            <th class="text-center">پرداخت اقساط ضروری</th>
                            <th class="text-center">پرداخت اقساط عادی</th>
                            <th class="text-center">افزایش سرمایه</th>
                            <th class="text-center">ثبت کننده</th>
                            <th class="text-center">تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                @if($permission==1)
                                    <th class="text-center small">
                                        @if($payment->is_proved==0)
                                            <a href="{{ route('payment_confirm',['id'=>$payment->id]) }}">
                                                <button type="button" class="btn btn-sm btn-success"
                                                        onclick="return confirm('از تایید کردن این پرداخت اطمینان دارید؟')"
                                                >تایید
                                                </button>
                                            </a>
                                        @else
                                            تایید شده
                                        @endif
                                    </th>
                                    <th class="text-center small">
                                        <a href="{{ route('edit_payment_form',['id'=>$payment->id]) }}">
                                            <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                        </a>
                                    </th>
                                @endif

                                <th class="text-center small">
                                    @if($permission==1 || $payment->is_proved==0)
                                        <a href="{{ route('payment_delete',['id'=>$payment->id]) }}"
                                           onclick="return confirm('آیا از حذف پرداخت اطمینان دارید؟')" >
                                            <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                        </a>
                                    @else
                                        ممکن نیست
                                    @endif
                                </th>

                                <th class="text-center small">@if ($payment->is_proved==0)
                                        { تایید نشده }
                                    @elseif(is_numeric($payment->proved_by))
                                        زرین پال
                                        {{$payment->proved_by}}
                                    @else
                                        {{$payment->proved_by}}
                                    @endif
                                </th>
                                <th class="text-center">{{$payment->delay}}</th>
                                <th class="text-center small">{{$payment->note}}</th>
                                <th class="text-center small">{{$payment->description}}</th>
                                <th class="text-center">{{$payment->momentary}}</th>
                                <th class="text-center">{{$payment->sum}}</th>
                                <th class="text-center">{{$payment->payment_cost}}</th>
                                <th class="text-center">{{$payment->loan_payment_force}}</th>
                                <th class="text-center">{{$payment->loan_payment}}</th>
                                <th class="text-center">{{$payment->payment}}</th>
                                <th class="text-center small">{{$payment->creator}}</th>
                                <th class="text-center small">{{Str_before($payment->date_time,' ')}}</th>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--<div class="text-center"> {{$payments->links()}} </div>--}}
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    {{--<a href="{{ route('pdf',['id'=>$user->id,'mode'=>'loan','date'=>'all']) }}" style="text-decoration:none">--}}
                        {{--<button type="button" class="btn btn-sm btn-success" dir="rtl">--}}
                            {{--نسخه pdf--}}
                        {{--</button>--}}
                    {{--</a>--}}
                    قرض الحسنه ها
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            @if($permission==1)
                                <th class="text-center">تایید قرض الحسنه</th>
                                <th class="text-center">ویرایش قرض الحسنه</th>
                            @endif
                            <th class="text-center">حذف قرض الحسنه</th>
                            <th class="text-center">تاریخ تایید</th>
                            <th class="text-center">تایید توسط</th>
                            <th class="text-center">توضیحات مدیر</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">تاریخ مورد نیاز قرض الحسنه</th>
                            <th class="text-center">مبلغ قرض الحسنه</th>
                            <th class="text-center">نوع قرض الحسنه</th>
                            <th class="text-center">ثبت کننده</th>
                            <th class="text-center">تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($loans as $loan)
                            <tr class="text-center">
                                @if($permission==1)
                                    <th class="text-center small">
                                    @if($loan->is_proved==0)
                                        <a href="{{ route('loan_confirm',['id'=>$loan->id]) }}">
                                            <button type="button" class="btn btn-sm btn-success"
                                                    onclick="return confirm('از تایید کردن این قرض الحسنه اطمینان دارید؟')">
                                                تایید
                                            </button>
                                        </a>
                                    @else
                                        تایید شده
                                    @endif
                                    </th>
                                    <th class="text-center small">
                                        <a href="{{ route('edit_loan_form',['id'=>$loan->id]) }}">
                                            <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                        </a>
                                    </th>
                                @endif
                                <th class="text-center small">
                                    @if($permission==1 || $loan->is_proved==0)
                                        <a href="{{ route('loan_delete',['id'=>$loan->id]) }}"
                                           onclick="return confirm('آیا از حذف قرض الحسنه اطمینان دارید؟')" >
                                            <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                        </a>
                                    @else
                                        ممکن نیست
                                    @endif
                                </th>
                                <th class="text-center small">@if ($loan->is_proved==0){ تایید نشده }@else{{Str_before(Verta($loan->updated_at),' ')}} @endif</th>
                                <th class="text-center small">@if ($loan->is_proved==0){ تایید نشده }@else{{$loan->proved_by}} @endif</th>
                                <th class="text-center small">{{$loan->note}}</th>
                                <th class="text-center small">{{$loan->description}}</th>
                                <th class="text-center small">{{$loan->request_date}}</th>
                                <th class="text-center">{{$loan->loan}}</th>
                                <th class="text-center small">@if ($loan->force==0)عادی@else<span class="text-danger" >ضروری</span>@endif</th>
                                <th class="text-center small">{{$loan->creator}}</th>
                                <th class="text-center small">{{Str_before($loan->date_time,' ')}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center"> {{$loans->links()}} </div>
                </div>
            </div>

            @if(!$requests->count()==0)
                <div class="panel panel-danger">
                    <div class="panel-heading text-center">
                        {{--<a href="{{ route('pdf',['id'=>$user->id,'mode'=>'request','date'=>'all']) }}" style="text-decoration:none">--}}
                            {{--<button type="button" class="btn btn-sm btn-danger" dir="rtl">--}}
                                {{--نسخه pdf--}}
                            {{--</button>--}}
                        {{--</a>--}}
                        درخواست ها
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                @if($permission==1)
                                    <th class="text-center">تایید درخواست</th>
                                    <th class="text-center">حذف درخواست</th>
                                    <th class="text-center">ویرایش درخواست</th>
                                @endif
                                <th class="text-center">توضیحات مدیر</th>
                                <th class="text-center">متن درخواست - توضیحات</th>
                                <th class="text-center"><a data-toggle="tooltip" title="در صورت درخواست برداشت از حساب"><span class="glyphicon glyphicon-question-sign"></span></a>مبلغ درخواست</th>
                                <th class="text-center">نوع درخواست</th>
                                <th class="text-center">ثبت کننده</th>
                                <th class="text-center">تاریخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    @if($permission==1)
                                        <th class="text-center">
                                            @if($request->is_proved==0)
                                            <a href="{{ route('request_confirm',['id'=>$request->id]) }}">
                                                <button type="button" class="btn btn-success"
                                                        onclick="return confirm('از تایید کردن این درخواست اطمینان دارید؟')"
                                                >تایید
                                                </button>
                                            </a>
                                            @else
                                                تایید شده
                                            @endif
                                        </th>
                                        <th class="text-center small">
                                            <a href="{{ route('request_delete',['id'=>$request->id]) }}"
                                               onclick="return confirm('آیا از حذف درخواست اطمینان دارید؟')" >
                                                <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                            </a>
                                        </th>
                                        <th class="text-center small">
                                            <a href="{{ route('request_edit',['id'=>$request->id]) }}">
                                                <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                            </a>
                                        </th>
                                    @endif
                                    <th class="text-center small">{{ $request->note }}</th>
                                    <th dir="rtl" class="text-center small">
                                        @if($request->type==-1)
                                            {{'لطفا مبلغ مزبور از محل سرمایه اینجانب پرداخت نمایید'.'-'.$request->description }}
                                        @elseif($request->type==0)
                                            {{'لطفا حساب اینجانب بسته شود و تسویه حساب کامل صورت پذیرد.'.'-'.$request->description }}
                                        @endif
                                    </th>
                                    <th class="text-center">@if($request->fee!=null){{ $request->fee }}@else - @endif</th>
                                    <th class="text-center small">@if($request->type==-1)برداشت از سرمایه@elseبستن حساب و تسویه@endif</th>
                                    <th class="text-center small">{{ $request->creator }}</th>
                                    <th class="text-center small">{{ Str_before($request->date_time,' ') }}</th>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection