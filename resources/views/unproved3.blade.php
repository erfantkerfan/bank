@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">لیست پرداخت های آنلاین بدون ثبت تاخیر</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">ویرایش</th>
                                <th class="text-center">توضیحات مدیر</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">هزینه صندوق</th>
                                <th class="text-center">پرداخت اقساط ضروری</th>
                                <th class="text-center">پرداخت اقساط عادی</th>
                                <th class="text-center">افزایش سرمایه</th>
                                <th class="text-center">تاریخ</th>
                                <th class="text-center">ثبت کننده</th>
                                <th class="text-center">نام عضو</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($onlines as $online)
                            <tr class="bg-warning">
                                <th class="text-center">
                                    <a href="{{ route('edit_payment_form',['id'=>$online->payment->id]) }}">
                                        <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                    </a>
                                </th>
                                <th class="text-center">{{$online->payment->note}}</th>
                                <th class="text-center">{{$online->payment->description}}</th>
                                <th class="text-center">{{$online->payment->payment_cost}}</th>
                                <th class="text-center">{{$online->payment->loan_payment_force}}</th>
                                <th class="text-center">{{$online->payment->loan_payment}}</th>
                                <th class="text-center">{{$online->payment->payment}}</th>
                                <th class="text-center">{{Str_before($online->payment->date_time,' ')}}</th>
                                <th class="text-center">{{$online->payment->creator}}</th>
                                {{--<th class="text-center">--}}
                                    {{--<a href="{{ route('user',['id'=>$online->user->id]) }}">--}}
                                        {{--{{$online->user->f_name." ".$online->user->l_name}}--}}
                                    {{--</a>--}}
                                {{--</th>--}}
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