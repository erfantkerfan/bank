@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">درج پرداخت</div>
                <div class="panel-body bg-success">
                    <form class="form" method="POST" action="{{ route('transaction',['id'=>$payment->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                            <label for="payment" class="col-md-1 control-label">افزایش سرمایه</label>
                            <div class="col-md-2">
                                <input id="payment" type="text" class="form-control" name="payment" value="{{ $payment->payment }}" required autofocus>

                                @if ($errors->has('payment'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('payment') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('loan_payment') ? ' has-error' : '' }}">
                            <label for="loan_payment" class="col-md-1 control-label">پرداخت اقساط</label>
                            <div class="col-md-2">
                                <input id="loan_payment" type="text" class="form-control" name="loan_payment" value="{{ $payment->loan_payment }}" autofocus>

                                @if ($errors->has('loan_payment'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('loan_payment') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('loan') ? ' has-error' : '' }}">
                            <label for="loan" class="col-md-1  control-label">مبلغ درخواست قرض الحسنه</label>
                            <div class="col-md-2">
                                <input id="loan" type="text" class="form-control" name="loan" value="{{ $payment->loan }}" autofocus>

                                @if ($errors->has('loan'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('loan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-1 control-label">توضیحات</label>
                            <div class="col-md-2">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $payment->description }}" autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br> </br>

                        <div class="form-group{{ $errors->has('date_time') ? ' has-error' : '' }}">
                            <label for="date_time" class="col-md-1  control-label">تاریخ پرداخت یا درخواست</label>
                            <div class="col-md-2">
                                <input id="date_time" type="text" class="form-control" name="date_time" value="{{ Str_before($payment->date_time,' ') }}" required autofocus>

                                @if ($errors->has('date_time'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('date_time') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_proved') ? ' has-error' : '' }}">
                            <label for="is_proved" class="col-md-1 control-label">تایید شدن مدیر</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="is_proved" value="0" @if($payment->is_proved==0)checked @endif>خیر</label>
                                <label class="radio-inline"><input type="radio" name="is_proved" value="1" @if($payment->is_proved==1)checked @endif>بله</label>

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
@endsection
