@extends('layouts.app')

@section('content')
    <div class="container text-center">

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">درج تماس با ما و تنظیمات</div>
                <div class="panel-body bg-success">
                    <form class="form" method="POST" action="{{ route('config') }}">
                        {{ csrf_field() }}

                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary">
                                درج
                            </button>
                        </div>

                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            <div class="col-md-8">
                            <textarea dir="rtl" id="text" class="form-control" name="text" style="resize: none"
                                      placeholder="مقدار(روز و ساعت های کاری با , لاتین از هم جدا شوند)(تیتر و متن قوانین با , لاتین از هم جدا شوند)" required autofocus>{{ old('text') }}</textarea>
                                @if ($errors->has('text'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <div class="col-md-2">
                                <label class="sr-only" for="type">type</label>
                                <select id="type" name="type" class="form-control" required>
                                    <option value="" selected>...انتخاب کنید</option>
                                    <option value="law">قوانین</option>
                                    <option value="hour">ساعت کاری</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">تغییر تماس با ما و تنظیمات</div>
                <div class="panel-body" dir="rtl">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">نوع</th>
                            <th class="text-center">مقدار</th>
                            <th class="text-center">اصلاح</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($configs as $config)
                            <tr>
                                <td class="text-center">
                                    @if($config->type=='top_h')
                                        متن قبل از ساعت کاری
                                    @elseif($config->type=='down_h')
                                        متن بعد از ساعت کاری
                                    @elseif($config->type=='hour')
                                        ساعت کاری
                                    @elseif($config->type=='law')
                                        قوانین
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($config->type!='law')
                                        <input form="config_form{{$loop->iteration}}" type="text" class="form-control" name="text" id="text" value="{{$config->text}}">
                                    @else
                                        <textarea form="config_form{{$loop->iteration}}" class="form-control" name="text" id="text" style="resize: vertical" dir="rtl">{!! nl2br(e($config->text)) !!}</textarea>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form id="config_form{{$loop->iteration}}" method="post" action="{{ route('config') }}">
                                        <input type="hidden" form="config_form{{$loop->iteration}}" name="_token" value="{{ csrf_token() }}">
                                        <input form="config_form{{$loop->iteration}}" type="hidden" class="form-control" name="id" id="id" value="{{$config->id}}">
                                        <button form="config_form{{$loop->iteration}}" type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-check" style="color:#0056b3"></span>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="{{route('config')}}" method="post" onclick="return confirm('از پاک کردن این تنظیم اطمینان دارید؟')">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <input type="hidden" class="form-control" name="id" id="id" value="{{$config->id}}">
                                        @if($config->type=='law' || $config->type=='hour')
                                            <button class="btn btn-default" type="submit">
                                                <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection