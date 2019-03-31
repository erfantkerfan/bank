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
    <h1 style="text-align: center;">درخواست ها</h1>
    <table>
        <thead>
        <tr>
            <th>توضیحات مدیر</th>
            <th>متن درخواست - توضیحات</th>
            <th>مبلغ درخواست</th>
            <th>نوع درخواست</th>
            <th>ثبت کننده</th>
            <th>تاریخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <tr>
                <th >{{ $request->note }}</th>
                <th dir="rtl" >
                    @if($request->type==-1)
                        {{'لطفا مبلغ مزبور از محل سرمایه اینجانب پرداخت نمایید'.'-'.$request->description }}
                    @elseif($request->type==0)
                        {{'لطفا حساب اینجانب بسته شود و تسویه حساب کامل صورت پذیرد.'.'-'.$request->description }}
                    @endif
                </th>
                <th>@if($request->fee!=null){{ $request->fee }}@else - @endif</th>
                <th >@if($request->type==-1)برداشت از سرمایه@elseبستن حساب و تسویه@endif</th>
                <th >{{ $request->creator }}</th>
                <th >{{ Str_before($request->date_time,' ') }}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>