@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">

                    <div class="panel-heading">ویرایش درخواست</div>

                    <div dir="rtl" class="panel-body bg-success">
                        <form class="form" method="POST" action="{{ route('request_edit',['id'=>$request->id]) }}">
                            {{ csrf_field() }}

                            @if($request->type==-1)
                                <div style="color: red">درخواست از نوع برداشت</div>
                            @else
                                <div style="color: red">درخواست از نوع تسویه حساب</div>
                            @endif
                            <br>

                            @if($request->type==-1)
                            <div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
                                <label for="fee" class="control-label">مبلغ:</label>
                                <div class="col-md-7">
                                    <input id="fee" type="text" class="form-control" name="fee" value="{{ $request->fee }}" placeholder="مبلغ به ریال" autofocus>

                                    @if ($errors->has('fee'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fee') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="control-label">توضیحات:</label>
                                <div class="col-md-7">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ $request->description }}" autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="note" class="control-label">یادداشت مدیریت</label>
                                <div class="col-md-7">
                                    <input id="note" type="text" class="form-control" name="note" value="{{ $request->note }}" autofocus>

                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="form-group">
                                <div >
                                    <button name="online_payment" value="0" type="submit" class="btn btn-primary">
                                        ویرایش درخواست
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
