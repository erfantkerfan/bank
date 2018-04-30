@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">ثبت اطلاعات کاربر</div>
                <div class="panel-body bg-success">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">نام کاربری</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                                           required autofocus placeholder="انگلیسی شامل حروف، اعداد و زیرخط">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('f_name') ? ' has-error' : '' }}">
                                <label for="f_name" class="col-md-4 control-label">نام</label>

                                <div class="col-md-6">
                                    <input id="f_name" type="text" class="form-control" name="f_name" value="{{ old('f_name') }}"
                                           required autofocus placeholder="فارسی">

                                    @if ($errors->has('f_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('l_name') ? ' has-error' : '' }}">
                                <label for="l_name" class="col-md-4 control-label">نام خانوادگی</label>

                                <div class="col-md-6">
                                    <input id="l_name" type="text" class="form-control" name="l_name" value="{{ old('l_name') }}"
                                           required autofocus placeholder="فارسی">

                                    @if ($errors->has('l_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('l_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('acc_id') ? ' has-error' : '' }}">
                                <label for="acc_id" class="col-md-4 control-label">شماره حساب</label>

                                <div class="col-md-6">
                                    <input id="acc_id" type="text" class="form-control" name="acc_id" value="{{ old('acc_id') }}"
                                           required autofocus>

                                    @if ($errors->has('acc_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('acc_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">پست الکترونیکی</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="col-md-4 control-label">شماره همراه</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}"
                                           required autofocus>

                                    @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('faculty_number') ? ' has-error' : '' }}">
                                <label for="faculty_number" class="col-md-4 control-label">شماره داخلی یا محل کار</label>

                                <div class="col-md-6">
                                    <input id="faculty_number" type="text" class="form-control" name="faculty_number" value="{{ old('faculty_number') }}"
                                           autofocus>

                                    @if ($errors->has('faculty_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('faculty_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('home_number') ? ' has-error' : '' }}">
                                <label for="home_number" class="col-md-4 control-label">شماره منزل</label>

                                <div class="col-md-6">
                                    <input id="home_number" type="text" class="form-control" name="home_number" value="{{ old('home_number') }}"
                                           autofocus>

                                    @if ($errors->has('home_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('relation') ? ' has-error' : '' }}">
                                <label for="relation" class="col-md-4 control-label">ارتباط با کاربر دیگر</label>

                                <div class="col-md-6">
                                    <input id="relation" type="text" class="form-control" name="relation" value="{{ old('relation') }}"
                                           autofocus placeholder="نسبت فامیلی با کاربر اصلی">

                                    @if ($errors->has('relation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('relation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
                                <label for="is_admin" class="col-md-4 control-label">دسترسی بازرس</label>
                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio" name="is_admin" value="0" checked>خیر</label>
                                    <label class="radio-inline"><input type="radio" name="is_admin" value="1" onclick="return confirm('از دادن سطح مدیریتی اطمینان دارید؟')" >بله</label>

                                    @if ($errors->has('is_admin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('is_admin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('is_super_admin') ? ' has-error' : '' }}">
                                <label for="is_super_admin" class="col-md-4 control-label">دسترسی مدیریتی</label>
                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio" name="is_super_admin" value="0" checked>خیر</label>
                                    <label class="radio-inline"><input type="radio" name="is_super_admin" value="1" onclick="return confirm('از دادن سطح مدیریتی اطمینان دارید؟')" >بله</label>

                                    @if ($errors->has('is_super_admin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('is_super_admin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">رمز عبور</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                           required autofocus placeholder="بازیابی ندارد و توسط مدیران تجدید میشود">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">تکرار رمز عبور</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    ثبت اطلاعات
                                </button>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="note" class="col-md-4 control-label">یادداشت مدیریت</label>

                                <div class="col-md-6">
                                    <textarea id="note" class="form-control" name="note" autofocus placeholder="متن برای مشاهده کاربر" >{{ old('note') }}</textarea>

                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_note') ? ' has-error' : '' }}">
                                <label for="user_note" class="col-md-4 control-label">یادداشت کاربر</label>

                                <div class="col-md-6">
                                    <textarea id="user_note" class="form-control" name="user_note" autofocus>{{ old('user_note') }}</textarea>

                                    @if ($errors->has('user_note'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_note') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr style="background-color:crimson; height:3px;">

                            <div class="badge text-center">
                                قرض الحسنه عادی
                            </div>
                            <br>
                            <br>

                            <div class="form-group{{ $errors->has('instalment') ? ' has-error' : '' }}">
                                <label for="instalment" class="col-md-4 control-label">مبلغ اقساط</label>

                                <div class="col-md-6">
                                    <input id="instalment" class="form-control" type="text" name="instalment" autofocus value="{{ old('instalment') }}">

                                    @if ($errors->has('instalment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('instalment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
                                <label for="period" class="col-md-4 control-label">دوره بازپرداخت</label>

                                <div class="col-md-6">
                                    <input id="period" class="form-control" type="text" name="period" autofocus value="{{ old('period') }}">

                                    @if ($errors->has('period'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('period') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan_row') ? ' has-error' : '' }}">
                                <label for="loan_row" class="col-md-4 control-label">شماره ردیف</label>

                                <div class="col-md-6">
                                    <input id="loan_row" class="form-control" type="text" name="loan_row" autofocus value="{{ old('loan_row') }}">

                                    @if ($errors->has('loan_row'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('loan_row') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('Cheque') ? ' has-error' : '' }}">
                                <label for="Cheque" class="col-md-4 control-label">شماره چک</label>

                                <div class="col-md-6">
                                    <input id="Cheque" class="form-control" type="text" name="Cheque" autofocus value="{{ old('Cheque') }}">

                                    @if ($errors->has('Cheque'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Cheque') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="start_date" class="col-md-4 control-label">تاریخ شروع</label>

                                <div class="col-md-6">
                                    <input id="start_date" class="form-control" type="text" name="start_date" autofocus value="{{ old('start_date') }}">

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label for="end_date" class="col-md-4 control-label">تاریخ پایان</label>

                                <div class="col-md-6">
                                    <input id="end_date" class="form-control" type="text" name="end_date" autofocus value="{{ old('end_date') }}">

                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr style="background-color:crimson; height:3px;">

                            <div class="badge text-center">
                                قرض الحسنه ضروری
                            </div>
                            <br>
                            <br>

                            <div class="form-group{{ $errors->has('instalment_force') ? ' has-error' : '' }}">
                                <label for="instalment_force" class="col-md-4 control-label">مبلغ اقساط</label>

                                <div class="col-md-6">
                                    <input id="instalment_force" class="form-control" type="text" name="instalment_force" autofocus value="{{ old('instalment_force') }}">

                                    @if ($errors->has('instalment_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('instalment_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('period_force') ? ' has-error' : '' }}">
                                <label for="period_force" class="col-md-4 control-label">دوره بازپرداخت</label>

                                <div class="col-md-6">
                                    <input id="period_force" class="form-control" type="text" name="period_force" autofocus value="{{ old('period_force') }}">

                                    @if ($errors->has('period_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('period_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loan_row_force') ? ' has-error' : '' }}">
                                <label for="loan_row_force" class="col-md-4 control-label">شماره ردیف</label>

                                <div class="col-md-6">
                                    <input id="loan_row_force" class="form-control" type="text" name="loan_row_force" autofocus value="{{ old('loan_row_force') }}">

                                    @if ($errors->has('loan_row_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('loan_row_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('Cheque_force') ? ' has-error' : '' }}">
                                <label for="Cheque_force" class="col-md-4 control-label">شماره چک</label>

                                <div class="col-md-6">
                                    <input id="Cheque_force" class="form-control" type="text" name="Cheque_force" autofocus value="{{ old('Cheque_force') }}">

                                    @if ($errors->has('Cheque_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Cheque_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('start_date_force') ? ' has-error' : '' }}">
                                <label for="start_date_force" class="col-md-4 control-label">تاریخ شروع</label>

                                <div class="col-md-6">
                                    <input id="start_date_force" class="form-control" type="text" name="start_date_force" autofocus value="{{ old('start_date_force') }}">

                                    @if ($errors->has('start_date_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('end_date_force') ? ' has-error' : '' }}">
                                <label for="end_date_force" class="col-md-4 control-label">تاریخ پایان</label>

                                <div class="col-md-6">
                                    <input id="end_date_force" class="form-control" type="text" name="end_date_force" autofocus value="{{ old('end_date_force') }}">

                                    @if ($errors->has('end_date_force'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date_force') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
