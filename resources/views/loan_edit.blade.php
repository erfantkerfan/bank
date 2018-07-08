@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">

            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">ویرایش قرض الحسنه</div>

                        <div class="panel-body bg-success">
                            <form class="form" method="POST" action="{{ route('edit_loan',['id'=>$loan->id]) }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('loan') ? ' has-error' : '' }}">
                                    <label for="loan" class="control-label">
                                        :
                                        مبلغ قرض الحسنه
                                    </label>
                                    <div class="col-md-7">
                                        <input id="loan" type="text" class="form-control" name="loan" value="{{ $loan->loan }}" placeholder="مبلغ به ریال" autofocus>

                                        @if ($errors->has('loan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('loan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('request_date') ? ' has-error' : '' }}">
                                    <label for="request_date" class="control-label">:تاریخ مورد نیاز</label>
                                    <div class="col-md-7">
                                        <input id="request_date" type="text" class="form-control" name="request_date" value="{{ $loan->request_date }}" autofocus>

                                        @if ($errors->has('request_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('request_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="control-label">:توضیحات</label>
                                    <div class="col-md-7">
                                        <input dir="rtl" id="description" type="text" class="form-control" name="description" value="{{ $loan->description }}" placeholder="میتواند خالی باشد" autofocus>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                    <label for="description" class="control-label">:توضیحات مدیر</label>
                                    <div class="col-md-7">
                                        <input dir="rtl" id="note" type="text" class="form-control" name="note" value="{{ $loan->note }}" placeholder="میتواند خالی باشد" autofocus>

                                        @if ($errors->has('note'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('note') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('force') ? ' has-error' : '' }}">
                                    <label for="force" class="control-label">:نوع قرض الحسنه</label>
                                    <div class="col-md-7">
                                        <label class="radio-inline"><input type="radio" name="force" value="0" @if($loan->force==0)checked @endif>عادی</label>
                                        <label class="radio-inline"><input type="radio" name="force" value="1" @if($loan->force==1)checked @endif>ضروری</label>

                                        @if ($errors->has('force'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('force') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary">
                                            ویرایش
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