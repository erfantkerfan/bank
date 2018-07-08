@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="panel panel-primary">

                    <div class="panel-heading">ویرایش پرداخت</div>

                    <div class="panel-body bg-success">
                        <form class="form" method="POST" action="{{ route('edit_payment',['id'=>$payment->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                                <label for="payment" class="control-label">:افزایش سرمایه</label>
                                <div class="col-md-7">
                                    <input id="payment" type="text" class="form-control" name="payment" value="{{ $payment->payment }}" placeholder="صفر یا مبلغ به ریال" required autofocus>

                                    @if ($errors->has('payment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('payment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan_payment') ? ' has-error' : '' }}">
                                <label for="loan_payment" class="control-label">:اقساط قرض الحسنه عادی</label>
                                <div class="col-md-7">
                                    <input id="loan_payment" type="text" class="form-control" name="loan_payment" value="{{ $payment->loan_payment }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('loan_payment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('loan_payment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan_payment_force') ? ' has-error' : '' }}">
                                <label for="loan_payment_force" class="control-label">:اقساط قرض الحسنه ضروری</label>
                                <div class="col-md-7">
                                    <input id="loan_payment_force" type="text" class="form-control" name="loan_payment_force" value="{{ $payment->loan_payment_force }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('loan_payment_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('loan_payment_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_cost') ? ' has-error' : '' }}">
                                <label for="payment_cost" class="control-label">: هزینه های صندوق</label>
                                <div class="col-md-7">
                                    <input id="payment_cost" type="text" class="form-control" name="payment_cost" value="{{ $payment->payment_cost }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('payment_cost'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('payment_cost') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('delay') ? ' has-error' : '' }}">
                                <label for="delay" class="control-label">:تعداد روزهای تاخیر</label>
                                <div class="col-md-7">
                                    <input id="delay" type="text" class="form-control" name="delay" value="{{ $payment->delay }}" placeholder="مثبت به معنای تاخیر است و بالعکس" autofocus>

                                    @if ($errors->has('delay'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('delay') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="control-label">:توضیحات</label>
                                <div class="col-md-7">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ $payment->description }}" placeholder="میتواند خالی باشد" autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="note" class="control-label">:توضیحات مدیر</label>
                                <div class="col-md-7">
                                    <input id="note" type="text" class="form-control" name="note" value="{{ $payment->note }}" placeholder="میتواند خالی باشد" autofocus>

                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button name="online_payment" value="0" type="submit" class="btn btn-primary">
                                        ویرایش پرداخت
                                    </button>

                                </div>
                            </div>

                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
