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
    <h1 style="text-align: center;">پرداخت ها</h1>
    <table>
        <thead>
        <tr>
            <th >تایید توسط</th>
            <th>امتیاز پرداخت به موقع</th>
            <th>توضیحات مدیر</th>
            <th>توضیحات</th>
            <th>مجموع پرداختی</th>
            <th>پرداخت هزینه صندوق</th>
            <th>پرداخت اقساط ضروری</th>
            <th>پرداخت اقساط عادی</th>
            <th>افزایش سرمایه</th>
            <th>ثبت کننده</th>
            <th>تاریخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <th>@if ($payment->is_proved==0){ تایید نشده }@else{{$payment->proved_by}} @endif</th>
                <th>{{$payment->delay}}</th>
                <th>{{$payment->note}}</th>
                <th>{{$payment->description}}</th>
                <th>{{$payment->sum}}</th>
                <th>{{$payment->payment_cost}}</th>
                <th>{{$payment->loan_payment_force}}</th>
                <th>{{$payment->loan_payment}}</th>
                <th>{{$payment->payment}}</th>
                <th>{{$payment->creator}}</th>
                <th>{{Str_before($payment->date_time,' ')}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>