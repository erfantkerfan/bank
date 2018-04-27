@extends('layouts.app')

@section('content')
    <div class="container text-center">

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">درج اعلان</div>
                <div class="panel-body bg-success">
                    <form class="form" method="POST" action="{{ route('notification_create') }}">
                        {{ csrf_field() }}

                        <div class="form-group col-md-1">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    نشر اعلان
                                </button>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('notification') ? ' has-error' : '' }}">
                            <div class="col-md-11">
                                <textarea dir="rtl" id="notification" class="form-control" name="notification" style="resize: vertical"
                                          placeholder="متن اعلان عمومی" required autofocus>{{ old('notification') }}</textarea>

                                @if ($errors->has('notification'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('notification') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">اعلان های فعال</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="col-md-2 text-center">حذف اعلان</th>
                            <th class="col-md-5 text-center">متن اعلان</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <th class="text-center">
                                    <a onclick="return confirm('از پاک کردن این اعلان اطمینان دارید؟')"
                                       href="{{route('notification_delete',['id' => $notification->id])}}">
                                        <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                    </a>
                                </th>
                                <th class="text-center">{!! nl2br(e($notification->text)) !!}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection