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
                                    <span class="col-md-8">
                                    <button name="online_payment" value="0" type="submit" class="btn btn-primary"
                                            onclick="return confirm
                                            (' مجموع مبلغ پرداختی صحیح است؟ ' +
                                            numberWithCommas()+
                                            ' ریال '
                                            )">
                                        ثبت پرداخت
                                    </button>

                                    <button name="online_payment" value="1" type="submit" class="btn btn-success" disabled="">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                        پرداخت اینترنتی
                                    </button>
                                    </span>

                                    @if($permission==1)
                                        <div class="checkbox col-md-4">
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
                    <div class="panel-heading text-center">درج درخواست قرض الحسنه</div>
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
                                    <input id="loan" type="text" class="form-control" name="loan" value="{{ old('loan') }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('loan'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('loan') }}</strong>
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

                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت درخواست
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                    <textarea dir="rtl" style="resize: vertical" class="form-control form-group" name="user_note" rows="5" autofocus>{{ $user->user_note }}</textarea>

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
                <div class="panel-heading text-center">خلاصه وضعیت با احتساب تراکنش های تایید شده</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">مجموع روز های تاخیر</th>
                            <th class="text-center">کل پرداخت هزینه صندوق</th>
                            <th class="text-center">کل بدهی</th>
                            <th class="text-center">کل قرض الحسنه دریافتی</th>
                            <th class="text-center">سرمایه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-warning">
                            <td class="text-center">{{$user->delays()}}</td>
                            <td class="text-center">{{number_format($summary->payments_cost)}}</td>
                            <td class="text-center">{{number_format($summary->debt_force+$summary->debt)}}
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
                <div class="panel-heading text-center">پرداخت ها</div>
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
                            <th class="text-center">توضیحات</th>
                            <th class="text-center"><a data-toggle="tooltip" title="مثبت به معنای تاخیر است"><span class="glyphicon glyphicon-question-sign"></span></a>تعداد روز تاخیر</th>
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
                                    <th class="text-center">
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
                                    <th class="text-center">
                                        <a href="{{ route('edit_payment_form',['id'=>$payment->id]) }}">
                                            <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                        </a>
                                    </th>
                                @endif

                                <th class="text-center">
                                    @if($permission==1 || $payment->is_proved==0)
                                        <a href="{{ route('payment_delete',['id'=>$payment->id]) }}"
                                           onclick="return confirm('آیا از حذف پرداخت اطمینان دارید؟')" >
                                            <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                        </a>
                                    @else
                                         تایید شده
                                    @endif
                                </th>

                                <th class="text-center">@if ($payment->is_proved==0){ تایید نشده }@else{{$payment->proved_by}} @endif</th>
                                <th class="text-center">{{$payment->description}}</th>
                                <th class="text-center">{{$payment->delay}}</th>
                                <th class="text-center">{{$payment->sum}}</th>
                                <th class="text-center">{{$payment->payment_cost}}</th>
                                <th class="text-center">{{$payment->loan_payment_force}}</th>
                                <th class="text-center">{{$payment->loan_payment}}</th>
                                <th class="text-center">{{$payment->payment}}</th>
                                <th class="text-center">{{$payment->creator}}</th>
                                <th class="text-center">{{Str_before($payment->date_time,' ')}}</th>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center"> {{$payments->links()}} </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading text-center">قرض الحسنه ها</div>
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
                            <th class="text-center">توضیحات</th>
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
                                    <th class="text-center">
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
                                    <th class="text-center">
                                        <a href="{{ route('edit_loan_form',['id'=>$loan->id]) }}">
                                            <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                        </a>
                                    </th>
                                @endif
                                <th class="text-center">
                                    @if($permission==1 || $loan->is_proved==0)
                                        <a href="{{ route('loan_delete',['id'=>$loan->id]) }}"
                                           onclick="return confirm('آیا از حذف قرض الحسنه اطمینان دارید؟')" >
                                            <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                        </a>
                                    @else
                                        تایید شده
                                    @endif
                                </th>
                                <th class="text-center">@if ($loan->is_proved==0){ تایید نشده }@else{{Str_before(Verta($loan->updated_at),' ')}} @endif</th>
                                <th class="text-center">@if ($loan->is_proved==0){ تایید نشده }@else{{$loan->proved_by}} @endif</th>
                                <th class="text-center">{{$loan->description}}</th>
                                <th class="text-center">{{$loan->loan}}</th>
                                <th class="text-center">@if ($loan->force==0)عادی@else<span class="text-danger" >ضروری</span>@endif</th>
                                <th class="text-center">{{$payment->creator}}</th>
                                <th class="text-center">{{Str_before($loan->date_time,' ')}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center"> {{$loans->links()}} </div>
                </div>
            </div>

        </div>
    </div>

@endsection
