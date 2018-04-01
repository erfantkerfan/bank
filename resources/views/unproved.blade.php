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
                                <th class="text-center">نام کاربر</th>
                                <th class="text-center">تاریخ</th>
                                <th class="text-center">افزایش سرمایه</th>
                                <th class="text-center">پرداخت اقساط</th>
                                <th class="text-center">مبلغ درخواستی قرض الحسنه</th>
                                <th class="text-center">توضیحات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pays as $pay)
                            <tr class="bg-warning">
                                <th class="text-center"><a href="{{ route('transaction',['id'=>$pay->id]) }}">{{$pay->user->name}}</a></th>
                                <th class="text-center">{{Str_before($pay->date_time,' ')}}</th>
                                <th class="text-center">{{$pay->payment}}</th>
                                <th class="text-center">{{$pay->loan_payment}}</th>
                                <th class="text-center">{{$pay->loan}}</th>
                                <th class="text-center">{{$pay->description}}</th>
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