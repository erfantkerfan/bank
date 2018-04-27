@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">لیست پرداخت های تایید نشده</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">تایید پرداخت</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">هزینه صندوق</th>
                                <th class="text-center">پرداخت اقساط ضروری</th>
                                <th class="text-center">پرداخت اقساط عادی</th>
                                <th class="text-center">افزایش سرمایه</th>
                                <th class="text-center">تاریخ</th>
                                <th class="text-center">نام کاربر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                            <tr class="bg-warning">
                                <th class="text-center">
                                    <a href="{{ route('payment_confirm',['id'=>$payment->id]) }}">
                                        <button type="button" class="btn btn-success"
                                                onclick="return confirm('از تایید کردن این پرداخت اطمینان دارید؟')"
                                        >تایید
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">{{$payment->description}}</th>
                                <th class="text-center">{{$payment->payment_cost}}</th>
                                <th class="text-center">{{$payment->loan_payment_force}}</th>
                                <th class="text-center">{{$payment->loan_payment}}</th>
                                <th class="text-center">{{$payment->payment}}</th>
                                <th class="text-center">{{Str_before($payment->date_time,' ')}}</th>
                                <th class="text-center"><a href="{{ route('user',['id'=>$payment->user->id]) }}">{{$payment->user->f_name." ".$payment->user->l_name}}</a></th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">لیست قرض الحسنه های تایید نشده</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">تایید قرض الحسنه</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">مبلغ قرض الحسنه</th>
                                <th class="text-center">نوع قرض الحسنه</th>
                                <th class="text-center">تاریخ</th>
                                <th class="text-center">نام کاربر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($loans as $loan)
                            <tr class="bg-warning">
                                <th class="text-center">
                                    <a href="{{ route('loan_confirm',['id'=>$loan->id]) }}">
                                        <button type="button" class="btn btn-success"
                                            onclick="return confirm('از تایید کردن این قرض الحسنه اطمینان دارید؟')">
                                            تایید
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">{{$loan->description}}</th>
                                <th class="text-center">{{$loan->loan}}</th>
                                <th class="text-center">@if ($loan->force==0)عادی@else<span style="color:red" >ضروری</span>@endif</th>
                                <th class="text-center">{{Str_before($loan->date_time,' ')}}</th>
                                <th class="text-center"><a href="{{ route('user',['id'=>$payment->user->id]) }}">{{$loan->user->f_name." ".$loan->user->l_name}}</a></th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection