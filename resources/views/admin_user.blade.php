@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-13">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">:درج پرداخت</div>
                    <div class="panel-body bg-success">
                        <form class="form" method="POST" action="{{ route('home') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                                <label for="payment" class="control-label">:افزایش سرمایه</label>
                                <div class="col-md-3">
                                    <input id="payment" type="text" class="form-control" name="payment" value="{{ old('payment') }}" required autofocus>

                                    @if ($errors->has('payment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('payment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan_payment') ? ' has-error' : '' }}">
                                <label for="loan_payment" class="control-label">:پرداخت اقساط</label>
                                <div class="col-md-3">
                                    <input id="loan_payment" type="text" class="form-control" name="loan_payment" value="{{ old('loan_payment') }}" autofocus>

                                    @if ($errors->has('loan_payment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loan_payment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan') ? ' has-error' : '' }}">
                                <label for="loan" class="control-label">:مبلغ درخواستی قرض الحسنه</label>
                                <div class="col-md-3">
                                    <input id="loan" type="text" class="form-control" name="loan" value="{{ old('loan') }}" autofocus>

                                    @if ($errors->has('loan'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="control-label">:توضیحات</label>
                                <div class="col-md-3">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
                                <label for="date_time" class="control-label">:تاریخ پرداخت یا درخواست</label>
                                <div class="col-md-3">
                                    <input id="date_time" type="text" class="form-control" name="date_time" value="{{ verta()->formatdate() }}" required autofocus>

                                    @if ($errors->has('date_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('is_proved') ? ' has-error' : '' }}">
                                <label for="is_proved" class="control-label">:تایید شدن مدیریت</label>
                                <div class="col-md-3">
                                    <label class="radio-inline"><input type="radio" name="is_proved" value="0">خیر</label>
                                    <label class="radio-inline"><input type="radio" name="is_proved" value="1" checked>بله</label>

                                    @if ($errors->has('is_proved'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_proved') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-11">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت پرداخت
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-13">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">خلاصه وضعیت</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">افزایش سرمایه</th>
                                <th class="text-center">پرداخت اقساط</th>
                                <th class="text-center">آخرین قرض الحسنه</th>
                                <th class="text-center">قرض الحسنه دریافتی</th>
                                <th class="text-center">بدهی</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-warning">
                                <th class="text-center">{{$summary->payments}}</th>
                                <th class="text-center">{{$summary->loan_payments}}</th>
                                <th class="text-center">{{$summary->loan}}</th>
                                <th class="text-center">{{$summary->loans}}</th>
                                <th class="text-center">{{$summary->loans-$summary->loan_payments}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="panel panel-primary">
                    <div class="panel-heading text-center">تراکنش ها</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">حذف</th>
                                <th class="text-center">اصلاح</th>
                                <th class="text-center">تاریخ</th>
                                <th class="text-center">افزایش سرمایه</th>
                                <th class="text-center">قرض الحسنه</th>
                                <th class="text-center">پرداخت اقساط</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">آخرین تایید توسط</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <th class="text-center">
                                        <a href="{{route('delete',['id' => $payment->id])}}">
                                            <img src="/img/delete.png" alt="edit" height="6%"></a>
                                    </th>
                                    <th class="text-center">
                                        <a href="{{route('transaction',['id' => $payment->id])}}">
                                        <img src="/img/edit.png" alt="edit" height="4%"></a>
                                    </th>
                                    <th class="text-center">{{Str_before($payment->date_time,' ')}}</th>
                                    <th class="text-center">{{$payment->payment}}</th>
                                    <th class="text-center">{{$payment->loan}}</th>
                                    <th class="text-center">{{$payment->loan_payment}}</th>
                                    <th class="text-center">{{$payment->description}}</th>
                                    <th class="text-center">{{$payment->proved_by}}</th>
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
