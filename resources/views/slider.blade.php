@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">درج اسلایدر</div>

                <div class="panel-body bg-success">

                    <form class="form-row" method="POST"  enctype="multipart/form-data" action="{{ route('create_slider') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">:نام اسلایدر</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="برای شناسایی" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('head') ? ' has-error' : '' }}">
                            <label for="head" class="control-label">:تیتر</label>
                            <div class="col-md-9">
                                <input id="head" type="text" class="form-control" name="head" value="{{ old('head') }}" placeholder="میتواند خالی باشد" autofocus>

                                @if ($errors->has('head'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('head') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">:متن</label>
                            <div class="col-md-9">
                                <input id="body" type="text" class="form-control" name="body" value="{{ old('body') }}" placeholder="میتواند خالی باشد" autofocus>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <div class="col-md-9">
                                <input id="image" type="file" class="form-control-file" name="image" required accept=".jpg, .jpeg">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <div class="col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    درج اسلایدر
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">اسلایدرها</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">حذف</th>
                            <th class="text-center">متن</th>
                            <th class="text-center">تیتر</th>
                            <th class="text-center">نام</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr class="text-center">
                                <th class="text-center">
                                    <a href="{{ route('delete_slider',['id'=>$slider->id]) }}"
                                       onclick="return confirm('آیا از حذف هزینه اطمینان دارید؟')" >
                                        <span class="glyphicon glyphicon-trash" style="color:red"></span>
                                    </a>
                                </th>
                                <th class="text-center">{{$slider->body}}</th>
                                <th class="text-center">{{$slider->head}}</th>
                                <th class="text-center">{{$slider->name}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection