@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">یادداشت های فعال ادمین ها</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr class="bg-info">
                        <th class="col-md-2 text-center">نام کاربر</th>
                        <th class="text-center">متن یادداشت</th>
                        <th class="col-md-2 text-center">حذف یادداشت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name." ".$user->l_name}}</a></th>
                        <th class="text-center">{{$user->note}}</th>

                        <th class="text-center">
                            <a onclick="return confirm('از پاک کردن این یادداشت اطمینان دارید؟')" href="{{route('delete_notes',['id' => $user->id])}}">
                                <span class="glyphicon glyphicon-trash" style="color:red"></span>
                            </a>
                        </th>
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