@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">درج مبلغ هزینه</div>

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
                <div class="panel-heading text-center">لیست مخارج صندوق</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">باقیمانده هزینه ها</th>
                            <th class="text-center">هزینه های پرداختی تایید شده</th>
                            <th class="text-center">مجموع مخارج</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center">
                            <th class="text-center">{{$payments_cost-$expense}}</th>
                            <th class="text-center">{{$payments_cost}}</th>
                            <th class="text-center">{{$expense}}</th>
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
                                <th class="text-center">{{Str_before($expense->date_time,' ')}}</th>
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