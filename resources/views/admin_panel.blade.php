@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">خلاصه وضعیت صندوق</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr class="bg-info">
                                    <th class="text-center">افزایش سرمایه تایید شده</th>
                                    <th class="text-center">پرداخت اقسط تایید شده</th>
                                    <th class="text-center">قرض الحسنه های تایید شده</th>
                                    <th class="text-center">بدهی به صندوق تایید شده</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-warning">
                                    <th class="text-center">{{$all_payment_summary->payments_p}}</th>
                                    <th class="text-center">{{$all_payment_summary->loan_payments_p}}</th>
                                    <th class="text-center">{{$all_loan_summary->loans_p}}</th>
                                    <th class="text-center">{{$all_loan_summary->loans_p-$all_payment_summary->loan_payments_p}}</th>
                                </tr>
                            </tbody>
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">افزایش سرمایه تایید نشده</th>
                                <th class="text-center">پرداخت اقسط تایید نشده</th>
                                <th class="text-center">قرض الحسنه های تاییده نشده</th>
                                <th class="text-center">بدهی به صندوق تایید نشده</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-warning">
                                <th class="text-center">{{$all_payment_summary->payments_p}}</th>
                                <th class="text-center">{{$all_payment_summary->loan_payments_p}}</th>
                                <th class="text-center">{{$all_loan_summary->loans_p}}</th>
                                <th class="text-center">{{$all_loan_summary->loans_p-$all_payment_summary->loan_payments_p}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        ( لیست کاربران
                        ( کاربران فعال
                        {{ $users->count() }}
                    </div>
                    <div class="panel-body bg-success">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">نام و نام خانوادگی</th>
                                <th class="text-center">نام کاربری</th>
                                <th class="text-center">شماره حساب</th>
                                <th class="text-center">دسترسی بازرسی</th>
                                <th class="text-center">دسترسی مدیریتی</th>
                                <th class="text-center">اصلاح کاربر</th>
                                <th class="text-center">ارتباط با کاربر دیگر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->name}}</a></th>
                                    <th class="text-center">{{$user->username}}</th>
                                    <th class="text-center">{{$user->acc_id}}</th>
                                    <th class="text-center">
                                        @if ($user->is_admin==0)
                                            <img src="/img/0.png" alt="NO">
                                        @elseif ($user->is_admin==1)
                                            <img src="/img/1.png" alt="Yes">
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if ($user->is_super_admin==0)
                                            <img src="/img/0.png" alt="NO">
                                        @elseif ($user->is_super_admin==1)
                                            <img src="/img/1.png" alt="Yes">
                                        @endif
                                    </th>

                                    <th class="text-center">

                                    <a href="{{route('user_edit',['id' => $user->id])}}">
                                    <img src="/img/user-edit.png" alt="key"></a>
                                    </th>

                                    <th class="text-center">{{$user->relation}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center"> {{$users->links()}} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection