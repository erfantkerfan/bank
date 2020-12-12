@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">درخواست ها</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">تایید درخواست</th>
                            <th class="text-center">حذف درخواست</th>
                            <th class="text-center">ویرایش درخواست</th>
                            <th class="text-center">توضیحات مدیر</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center"><a data-toggle="tooltip" title="در صورت درخواست برداشت از حساب"><span class="glyphicon glyphicon-question-sign"></span></a>مبلغ درخواست</th>
                            <th class="text-center">نوع درخواست</th>
                            <th class="text-center">ثبت کننده</th>
                            <th class="text-center">تاریخ</th>
                            <th class="text-center">شماره حساب</th>
                            <th class="text-center">نام عضو</th>
                            <th class="text-center">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <th class="text-center">
                                    <a href="{{ route('request_confirm',['id'=>$request->id]) }}">
                                        <button type="button" class="btn btn-success"
                                                onclick="return confirm('از تایید کردن این درخواست اطمینان دارید؟')"
                                        >تایید
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    <a href="{{ route('request_delete',['id'=>$request->id]) }}"
                                       onclick="return confirm('آیا از حذف درخواست اطمینان دارید؟')" >
                                        <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                    </a>
                                </th>
                                <th class="text-center">
                                    <a href="{{ route('request_edit',['id'=>$request->id]) }}">
                                        <span class="glyphicon glyphicon-pencil" style="color:#6f42c1"></span>
                                    </a>
                                </th>
                                <th class="text-center">{{ $request->note }}</th>
                                <th class="text-center">{{ $request->description }}</th>
                                <th class="text-center">
                                    @if($request->fee!=null)
                                        {{ $request->fee }}
                                    @else
                                        -
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if($request->type==-1)
                                        برداشت از سرمایه
                                    @else
                                        بستن حساب و تسویه
                                    @endif
                                </th>
                                <th class="text-center">{{ $request->creator }}</th>
                                <th class="text-center">{{ Str::before($request->date_time,' ') }}</th>
                                <th class="text-center">{{ $request->user->acc_id }}</th>
                                <th class="text-center"><a href="{{ route('user',['id'=>$request->user->id]) }}">{{$request->user->f_name." ".$request->user->l_name}}</a></th>
                                <th class="text-center">{{$loop->iteration}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center"> {{$requests->appends(request()->query())->links()}} </div>
                </div>
            </div>
        </div>
    </div>
@endsection