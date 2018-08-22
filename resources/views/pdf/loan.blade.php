<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @font-face {
            font-family:'Font';
            src: url( {{asset('fonts/'.config('app.font'))}} );
        }
        body{
            font-family: 'Font', sans-serif;
        }
        table {
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
</head>
<body>
    <h1 style="text-align: center;">قرض الحسنه ها</h1>
    <table>
        <thead>
        <tr>
            <th>تاریخ تایید</th>
            <th>تایید توسط</th>
            <th>توضیحات مدیر</th>
            <th>توضیحات</th>
            <th>تاریخ مورد نیاز قرض الحسنه</th>
            <th>مبلغ قرض الحسنه</th>
            <th>نوع قرض الحسنه</th>
            <th>ثبت کننده</th>
            <th>تاریخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $loan)
            <tr>
                <th>@if ($loan->is_proved==0){ تایید نشده }@else{{Str_before(Verta($loan->updated_at),' ')}} @endif</th>
                <th>@if ($loan->is_proved==0){ تایید نشده }@else{{$loan->proved_by}} @endif</th>
                <th>{{$loan->note}}</th>
                <th>{{$loan->description}}</th>
                <th>{{$loan->request_date}}</th>
                <th>{{$loan->loan}}</th>
                <th>@if ($loan->force==0)عادی@else<span>ضروری</span>@endif</th>
                <th>{{$loan->creator}}</th>
                <th>{{Str_before($loan->date_time,' ')}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>