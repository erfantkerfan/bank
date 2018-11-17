@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">لیست قرض الحسنه های تایید نشده ضروری</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">تایید قرض الحسنه</th>
                                <th class="text-center">حذف</th>
                                <th class="text-center">ویرایش</th>
                                <th class="text-center">توضیحات مدیر</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">تاریخ مورد نیاز</th>
                                <th class="text-center">مبلغ قرض الحسنه</th>
                                <th class="text-center">تاریخ ثبت</th>
                                <th class="text-center">ثبت کننده</th>
                                <th class="text-center">نام عضو</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($loans_force as $loan)
                            <tr class="bg-warning">
                                <th class="text-center">
                                    <a href="{{ route('loan_confirm',['id'=>$loan->id]) }}">
                                        <button type="button" class="btn btn-success"
                                            onclick="return confirm('از تایید کردن این قرض الحسنه اطمینان دارید؟')">
                                            تایید
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    <a href="{{ route('loan_delete',['id'=>$loan->id]) }}"
                                       onclick="return confirm('آیا از حذف قرض الحسنه اطمینان دارید؟')" >
                                        <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                    </a>
                                </th>
                                <th class="text-center">
                                    <a href="{{ route('edit_loan_form',['id'=>$loan->id]) }}">
                                        <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                    </a>
                                </th>
                                <th class="text-center">{{$loan->note}}</th>
                                <th class="text-center">{{$loan->description}}</th>
                                <th class="text-center">{{$loan->request_date}}</th>
                                <th class="text-center">{{$loan->loan}}</th>
                                <th class="text-center">{{Str_before($loan->date_time,' ')}}</th>
                                <th class="text-center">{{$loan->creator}}</th>
                                <th class="text-center"><a href="{{ route('user',['id'=>$loan->user->id]) }}">{{$loan->user->f_name." ".$loan->user->l_name}}</a></th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">لیست قرض الحسنه های تایید نشده عادی</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">تایید قرض الحسنه</th>
                                <th class="text-center">حذف</th>
                                <th class="text-center">ویرایش</th>
                                <th class="text-center">توضیحات مدیر</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">تاریخ مورد نیاز</th>
                                <th class="text-center">مبلغ قرض الحسنه</th>
                                <th class="text-center">تاریخ ثبت</th>
                                <th class="text-center">ثبت کننده</th>
                                <th class="text-center">نام عضو</th>
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
                                    <th class="text-center">
                                        <a href="{{ route('loan_delete',['id'=>$loan->id]) }}"
                                           onclick="return confirm('آیا از حذف قرض الحسنه اطمینان دارید؟')" >
                                            <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                        </a>
                                    </th>
                                    <th class="text-center">
                                        <a href="{{ route('edit_loan_form',['id'=>$loan->id]) }}">
                                            <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                        </a>
                                    </th>
                                    <th class="text-center">{{$loan->note}}</th>
                                    <th class="text-center">{{$loan->description}}</th>
                                    <th class="text-center">{{$loan->request_date}}</th>
                                    <th class="text-center">{{$loan->loan}}</th>
                                    <th class="text-center">{{Str_before($loan->date_time,' ')}}</th>
                                    <th class="text-center">{{$loan->creator}}</th>
                                    <th class="text-center"><a href="{{ route('user',['id'=>$loan->user->id]) }}">{{$loan->user->f_name." ".$loan->user->l_name}}</a></th>
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