@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">اقساط فعال عادی</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr class="bg-info">
                        <th class="text-center">ویرایش</th>
                        <th class="text-center">حذف قسط</th>
                        <th class="text-center">
                            پرداخت اخیر
                            <a data-toggle="tooltip" title="کاربر در ۳۰ روز اخیر پرداختی داشته است">
                                <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                        </th>
                        <th class="text-center">شماره چک</th>
                        <th class="text-center">
                            <a href="{{ route('normal_instalments',array('sort'=>'loan_row')) }}">
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                </button>
                            </a>
                            شماره ردیف
                        </th>
                        <th class="text-center">
                            <a href="{{ route('normal_instalments',array('sort'=>'end_date')) }}">
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                </button>
                            </a>
                            تاریخ پایان اقساط
                        </th>
                        <th class="text-center">
                            <a href="{{ route('normal_instalments',array('sort'=>'start_date')) }}">
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                </button>
                            </a>
                            تاریخ شروع اقساط
                        </th>
                        <th class="text-center">مبلغ قسط</th>
                        <th class="text-center">نام عضو</th>
                        <th class="text-center">
                            <a href="{{ route('normal_instalments',array('sort'=>'acc_id')) }}">
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                </button>
                            </a>
                            #
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th class="text-center">
                            <a href="{{route('user_edit',['id' => $user->id])}}">
                                <button type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-cog" style="color:darkblue"></span>
                                </button>
                            </a>
                        </th>
                        <th class="text-center">
                            <a onclick="return confirm('از پاک کردن اطلاعات این قسط اطمینان دارید؟')"
                               href="{{route('delete_instalment',['id' => $user->id])}}">
                                <span class="glyphicon glyphicon-trash" style="color:red"></span>
                            </a>
                        </th>
                        <th class="text-center">
                            @if (count($user->recentPayments))
                                <span class="glyphicon glyphicon-ok" style="color:green"></span>
                            @else
                                <span class="glyphicon glyphicon-remove" style="color:red"></span>
                            @endif
                        </th>
                        <th class="text-center">{{$user->cheque}}</th>
                        <th class="text-center">{{$user->loan_row}}</th>
                        <th class="text-center">{{$user->end_date}}</th>
                        <th class="text-center">{{$user->start_date}}</th>
                        <th class="text-center">{{number_format($user->instalment)}}</th>
                        <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name." ".$user->l_name}}</a></th>
                        <th class="text-center">{{$loop->iteration}}</th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center"> {{$users->appends(request()->query())->links()}} </div>
            </div>
        </div>
    </div>
</div>
@endsection