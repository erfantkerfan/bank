@extends('errors.main')

@include('errors.links')

@section('content')
    <div class="row title m-b-md">
        <br>
        {{Auth::user()->f_name." ".Auth::user()->l_name}}
        <br>
        شما دسترسی به این بخش را ندارید
        <br>
    </div>
    <div class="row number font-red">403</div>
@endsection

