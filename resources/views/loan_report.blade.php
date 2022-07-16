@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/persian-datepicker.min.css"/>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">تاریخ گزارش</div>
                    <div class="panel-body alighn-contents-center">
                        <form class="form-horizontal" method="GET" action="{{ route('loan_report') }}">
                            <div class="col-md-2 form-group">
                                <button type="submit" class="btn btn-primary">
                                    تولید گزارش
                                </button>
                            </div>
                            <div class="col-md-4">
                                <input id="end_date" type="text" class="form-control datePicker" name="end_date" value="{{ $end_date }}" autocomplete="off">
                            </div>
                            <div class="col-md-1">
                                <div class="text-center">تا</div>
                            </div>
                            <div class="col-md-4">
                                <input id="start_date" type="text" class="form-control datePicker" name="start_date" value="{{ $start_date }}" autocomplete="off">
                            </div>
                            <div class="col-md-1">
                                <div class="text-center">از</div>
                            </div>
                        </form>
                    </div>
                </div>
            
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">گرازش وام های اعطایی</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">تعداد</th>
                                <th class="text-center">مبلغ</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-warning">
                                    <th class="text-center">{{$loans->count()}}</th>
                                    <th class="text-center">{{number_format($loans->sum('loan'))}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="panel panel-primary">
                    <div class="panel-heading text-center">گرازش وام های ضروری اعطایی</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">تعداد</th>
                                <th class="text-center">مبلغ</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-warning">
                                    <th class="text-center">{{$loans_force->count()}}</th>
                                    <th class="text-center">{{number_format($loans_force->sum('loan'))}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".datePicker").persianDatepicker(
                {
                    "inline": false,
                    "format": "YYYY-MM-DD",
                    "viewMode": "year",
                    "initialValue": false,
                    "autoClose": true,
                    "position": "auto",
                    "calendarType": "persian",
                    calendar:{
                        persian: {
                            locale: 'en'
                        }
                    }
                }
            );
        });
    </script>
@endsection