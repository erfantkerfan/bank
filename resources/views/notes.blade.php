@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">یادداشت های فعال ادمین ها</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="col-md-2 text-center">نام کاربر</th>
                            <th class="text-center">متن یادداشت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr class="bg-warning">
                            <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->name}}</a></th>
                            <th class="text-center">{{$user->note}}</th>
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