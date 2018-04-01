@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">اصلاح اطلاعات کاربر</div>
                <div class="panel-body bg-success">
                    <form class="form-horizontal" method="POST" action="{{ route('reregister',['id' => $user->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">نام کاربری</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">نام و نام خانوادگی</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

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
                                <input id="acc_id" type="text" class="form-control" name="acc_id" value="{{ $user->acc_id }}" required>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

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
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}" required>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('relation') ? ' has-error' : '' }}">
                            <label for="relation" class="col-md-4 control-label">ارتباط با کاربر دیگر</label>

                            <div class="col-md-6">
                                <input id="relation" type="text" class="form-control" name="relation" value="{{ $user->relation }}">

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
                                <textarea id="note" class="form-control" name="note" >{{ $user->note }}</textarea>

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
                            <label for="is_admin" class="col-md-4 control-label">دسترسی بازرس</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="is_admin" value="0" @if($user->is_admin==0)checked @endif>خیر</label>
                                <label class="radio-inline"><input type="radio" name="is_admin" value="1" @if($user->is_admin==1)checked @endif>بله</label>

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
                                <label class="radio-inline"><input type="radio" name="is_super_admin" value="0" @if($user->is_super_admin==0)checked @endif>خیر</label>
                                <label class="radio-inline"><input type="radio" name="is_super_admin" value="1" @if($user->is_super_admin==1)checked @endif>بله</label>

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
                                <input id="password" type="password" class="form-control" name="password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ثبت تغیرات
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
