@extends('errors.main')

@include('errors.links')

@section('content')
    <div class="row title m-b-md">
        این صفحه وجود ندارد
        <br>
        <img class="col-md-12 row" src="{{asset('img/maintenance_boy.gif')}}" style="width: 60%;float: none">
        <br>
    </div>
    <div class="row number font-red">404</div>
@endsection

