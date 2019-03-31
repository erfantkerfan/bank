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
    <h3 style="text-align: center;">گزارش کامل حساب {{$user->f_name.' '.$user->l_name}} در تاریخ {{$date}}</h3>

    <h2 style="text-align: center;">خلاصه وضعیت با احتساب تراکنش های تایید شده</h2>
    <table>
        <thead>
        <tr>
            <th>مجموع امتیاز پرداخت به موقع</th>
            <th>کل پرداخت بابت هزینه های صندوق</th>
            <th>کل بدهی</th>
            <th>کل قرض الحسنه ضروری دریافتی</th>
            <th>کل قرض الحسنه عادی دریافتی</th>
            <th>سرمایه</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="background-color: #dddddd">{{$user->delays()}}</td>
            <td style="background-color: #dddddd">{{number_format($summary->payments_cost)}}</td>
            <td style="background-color: #dddddd">{{number_format($summary->debt_force+$summary->debt)}}
            <td style="background-color: #dddddd">{{number_format($summary->loans_force_all)}}</td>
            <td style="background-color: #dddddd">{{number_format($summary->loans_all)}}</td>
            <td style="background-color: #dddddd">{{number_format($summary->payments)}}</td>
        </tr>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th>بدهی قرض الحسنه جاری ضروری</th>
            <th>قرض الحسنه جاری ضروری</th>
            <th>بدهی قرض الحسنه جاری عادی</th>
            <th>قرض الحسنه جاری عادی</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="background-color: #dddddd">{{number_format($summary->debt_force)}}</td>
            <td style="background-color: #dddddd">
                @if(is_int($summary->loan_force))
                    {{number_format($summary->loan_force)}}
                @else
                    {{$summary->loan_force}}
                @endif
            </td>
            <td style="background-color: #dddddd">{{number_format($summary->debt)}}</td>
            <td style="background-color: #dddddd">
                @if(is_int($summary->loan))
                    {{number_format($summary->loan)}}
                @else
                    {{$summary->loan}}
                @endif
            </td>
        </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">پرداخت ها</h2>
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

    <h2 style="text-align: center;">قرض الحسنه ها</h2>
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

    <h2 style="text-align: center;">درخواست ها</h2>
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