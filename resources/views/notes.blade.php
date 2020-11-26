@extends('layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">یادداشت های اعضا</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr class="bg-info">
                        <th class="text-center">ویرایش اطلاعات</th>
                        <th class="text-center">آخرین ورود</th>
                        <th class="text-center">حذف یادداشت</th>
                        <th class="text-center">تاریخ</th>
                        <th class="text-center">متن یادداشت عضو</th>
                        <th class="text-center">حذف یادداشت</th>
                        <th class="text-center">تاریخ</th>
                        <th class="text-center">متن یادداشت مدیر</th>
                        <th class="text-center">نام عضو</th>
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
                        <th class="text-center col-md-1" style="border-right: 1px solid #337ab7;">
                            {{Str::replaceArray(' ',['   '],Str::replaceArray('-',['/'],$user->new_login))}}
                        </th>
                        <th class="text-center">
                            <a onclick="return confirm('از پاک کردن این پیام اطمینان دارید؟')"
                               href="{{route('delete_user_note',['id' => $user->id])}}">
                                <span class="glyphicon glyphicon-trash" style="color:red"></span>
                            </a>
                        </th>
                        <th class="text-center col-md-1">{{Str::replaceArray('-',['/'],$user->user_note_date)}}</th>
                        <th class="text-center" style="border-right: 1px solid #337ab7;">{{$user->user_note}}</th>
                        <th class="text-center">
                            <a onclick="return confirm('از پاک کردن این پیام اطمینان دارید؟')"
                               href="{{route('delete_note',['id' => $user->id])}}">
                                <span class="glyphicon glyphicon-trash" style="color:red"></span>
                            </a>
                        </th>
                        <th class="text-center col-md-1">{{Str::replaceArray('-',['/'],$user->note_date)}}</th>
                        <th class="text-center">{{$user->note}}</th>
                        <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name." ".$user->l_name}}</a></th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center"> {{$users->links()}} </div>
            </div>
        </div>
    </div>
</div>
@endsection