@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">ثبت نام</div>
                <div class="panel-body bg-success">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">نام کاربری</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                                       required autofocus placeholder="Erfan_Gholizade  از نام کاربری انگلیسی استفاده شود مانند">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">نام کامل فارسی</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required autofocus placeholder="عرفان قلی زاده">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('acc_id') ? ' has-error' : '' }}">
                            <label for="acc_id" class="col-md-4 control-label">شماره حساب</label>

                            <div class="col-md-6">
                                <input id="acc_id" type="text" class="form-control" name="acc_id" value="{{ old('acc_id') }}"
                                       required autofocus placeholder="12345">

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
                                       required autofocus placeholder="erfantkerfan@yahoo.com">

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
                                       required autofocus placeholder="09125555555">

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('faculty_number') ? ' has-error' : '' }}">
                            <label for="faculty_number" class="col-md-4 control-label">شماره داخلی دانشگاه</label>

                            <div class="col-md-6">
                                <input id="faculty_number" type="text" class="form-control" name="faculty_number" value="{{ old('faculty_number') }}"
                                       autofocus placeholder="73932344">

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
                                       autofocus placeholder="02155555555">

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
                                       autofocus placeholder="پسر عرفان قلی زاده">

                                @if ($errors->has('relation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('relation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <div class="form-group{{ $errors->has('instalment') ? ' has-error' : '' }}">
                            <label for="instalment" class="col-md-4 control-label">مبلغ هر قسط</label>

                            <div class="col-md-6">
                                <textarea id="instalment" class="form-control" name="instalment" autofocus placeholder="مبلغ قسط یا خالی" >{{ old('instalment') }}</textarea>

                                @if ($errors->has('instalment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instalment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
                            <label for="is_admin" class="col-md-4 control-label">دسترسی مدیریتی</label>
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
                            <label for="is_super_admin" class="col-md-4 control-label">دسترسی مدیریتی سطح بالا</label>
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
                                       required autofocus placeholder="قابلیت بازیابی ندارد و فقط توسط مدیران تجدید میشود">

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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ثبت نام
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
