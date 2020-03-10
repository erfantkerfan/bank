@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">اقساط فعال ضروری</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr class="bg-info">
                        <th class="text-center">ویرایش</th>
                        <th class="text-center">حذف قسط</th>
                        <th class="text-center">شماره چک</th>
                        <th class="text-center">شماره ردیف</th>
                        <th class="text-center">
                            @if(basename(URL::current())=='acc_id')
                                <a href="{{ route('instalment_end_date2') }}">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                    </button>
                                </a>
                            @elseif(basename(URL::current())=='end_date')
                                <a href="{{ route('instalment2') }}">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-sort-by-order"></span>
                                    </button>
                                </a>
                            @endif
                            تاریخ پایان اقساط
                        </th>
                        <th class="text-center">تاریخ شروع اقساط</th>
                        <th class="text-center">مبلغ قسط</th>
                        <th class="text-center">نام عضو</th>
                        <th class="text-center">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users_force as $user_force)
                        <tr>
                            <th class="text-center">
                                <a href="{{route('user_edit',['id' => $user_force->id])}}">
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-cog" style="color:darkblue"></span>
                                    </button>
                                </a>
                            </th>
                            <th class="text-center">
                                <a onclick="return confirm('از پاک کردن اطلاعات این قسط اطمینان دارید؟')"
                                   href="{{route('delete_instalment_force',['id' => $user_force->id])}}">
                                    <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                </a>
                            </th>
                            <th class="text-center">{{$user_force->cheque_force}}</th>
                            <th class="text-center">{{$user_force->loan_row_force}}</th>
                            <th class="text-center">{{$user_force->end_date_force}}</th>
                            <th class="text-center">{{$user_force->start_date_force}}</th>
                            <th class="text-center">{{number_format($user_force->instalment_force)}}</th>
                            <th class="text-center"><a href="{{ route('user',['id'=>$user_force->id]) }}">{{$user_force->f_name." ".$user_force->l_name}}</a></th>
                            <th class="text-center">{{$loop->iteration}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center"> {{$users_force->links()}} </div>
            </div>

        </div>
    </div>
</div>
@endsection