@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">درج مخارج صندوق</div>

                <div class="panel-body bg-success">
                    <form class="form" method="POST" action="{{ route('expense_create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('expense') ? ' has-error' : '' }}">
                            <label for="expense" class="control-label">
                                :
                                مبلغ هزینه شده
                            </label>
                            <div class="col-md-7">
                                <input id="expense" type="text" class="form-control" name="expense" value="{{ old('expense') }}" placeholder="مبلغ به ریال" autofocus>

                                @if ($errors->has('expense'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('expense') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">:توضیحات</label>
                            <div class="col-md-7">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="میتواند خالی باشد" autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ثبت هزینه
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">هزینه، مخارج صندوق</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">موجودی</th>
                            <th class="text-center">(جمع دریافتی هزینه های صندوق(تایید شده</th>
                            <th class="text-center">مجموع مخارج</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center">
                            <th class="text-center">{{number_format($payments_cost-$expense)}}</th>
                            <th class="text-center">{{number_format($payments_cost)}}</th>
                            <th class="text-center">{{number_format($expense)}}</th>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center"> {{$expenses->links()}} </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">لیست مخارج صندوق</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">حذف هزینه</th>
                            <th class="text-center">ثبت شده توسط</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">مبلغ هزینه شده</th>
                            <th class="text-center">تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense)
                            <tr class="text-center">
                                <th class="text-center">
                                    <a href="{{ route('expense_delete',['id'=>$expense->id]) }}"
                                       onclick="return confirm('آیا از حذف هزینه اطمینان دارید؟')" >
                                        <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                    </a>
                                </th>
                                <th class="text-center">{{$expense->user->f_name.' '.$expense->user->l_name}}</th>
                                <th class="text-center">{{$expense->description}}</th>
                                <th class="text-center">{{$expense->expense}}</th>
                                <th class="text-center">{{Str::before($expense->date_time,' ')}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center"> {{$expenses->links()}} </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">لیست پرداخت بابت مخارج صندوق</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">مجموع هزینه های پرداختی تایید شده</th>
                            <th class="text-center">
                                آخرین فعالیت
                            </th>
                            <th class="text-center">ارتباط با عضو دیگر</th>
                            <th class="text-center">
                                شماره حساب
                            </th>
                            <th class="text-center">نام کاربری</th>
                            <th class="text-center">نام خانوادگی</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th class="text-center">{{$user->payments_cost}}</th>
                                <th class="text-center">{{Str::replaceArray(' ',['   '],str_replace('-','/',$user->new_login))}}</th>
                                <th class="text-center">{{$user->relation}}</th>
                                <th class="text-center">{{$user->acc_id}}</th>
                                <th class="text-center">{{$user->username}}</th>
                                <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->l_name}}</a></th>
                                <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name}}</a></th>
                                <th class="text-center">{{$loop->iteration}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center"> {{$expenses->links()}} </div>
                </div>
            </div>
        </div>

    </div>
@endsection