@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-primary">

                    <a data-toggle="collapse" href="#collapse1">
                        <div class="panel-heading">درج پرداخت</div>
                    </a>

                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body bg-success">
                            <form class="form" method="POST" action="{{ route('payment_create') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                                    <label for="payment" class="control-label">:افزایش سرمایه</label>
                                    <div class="col-md-7">
                                        <input id="payment" type="text" class="form-control" name="payment" value="{{ old('payment') }}" placeholder="صفر یا مبلغ به ریال" required autofocus>

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
                                        <input id="loan_payment" type="text" class="form-control" name="loan_payment" value="{{ old('loan_payment') }}" placeholder="مبلغ به ریال" autofocus>

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
                                        <input id="loan_payment_force" type="text" class="form-control" name="loan_payment_force" value="{{ old('loan_payment_force') }}" placeholder="مبلغ به ریال" autofocus>

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
                                        <input id="payment_cost" type="text" class="form-control" name="payment_cost" value="{{ old('payment_cost') }}" placeholder="مبلغ به ریال" autofocus>

                                        @if ($errors->has('payment_cost'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('payment_cost') }}</strong>
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

                                @if($permission==1)
                                    <div class="form-group{{ $errors->has('is_proved') ? ' has-error' : '' }}">
                                        <label for="is_proved" class="control-label">:تایید شدن مدیریت</label>
                                        <div class="col-md-7">
                                            <label class="radio-inline"><input type="radio" name="is_proved" value="0">خیر</label>
                                            <label class="radio-inline"><input type="radio" name="is_proved" value="1" checked>بله</label>

                                            @if ($errors->has('is_proved'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('is_proved') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div>
                                        <button name="online_payment" value="0" type="submit" class="btn btn-primary">
                                            ثبت پرداخت
                                        </button>

                                        <button name="online_payment" value="1" type="submit" class="btn btn-success" disabled="">
                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                            پرداخت اینترنتی
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