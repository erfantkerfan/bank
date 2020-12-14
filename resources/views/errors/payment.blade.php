@extends('errors.main')

@include('errors.links')

@section('content')
    <div class="row title m-b-md">
        پرداخت با خطا مواجه شد
        <br>
        <img class="col-md-12 row" src="{{asset('img/maintenance boy.gif')}}" style="width: 60%;float: none">
        <br>
    </div>
    <div class="row number font-red">999</div>
@endsection

