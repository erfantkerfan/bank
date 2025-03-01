@extends('errors.main')



@section('content')
    <div class="row title m-b-md">
        سایت در حال بروزرسانی یا تعمیر می باشد
        <br>
        <img class="col-md-12 row" src="{{asset('img/maintenance_boy.gif')}}" style="width: 60%;float: none">
        <br>
    </div>
    <div class="row number font-red">503</div>
@endsection

