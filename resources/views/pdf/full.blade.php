<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        th {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h3>گزارش کامل حساب {{$user->f_name.' '.$user->l_name}} در تاریخ {{$date}}</h3>
<br>
<br>
<br>
<h2>خلاصه وضعیت با احتساب تراکنش های تایید شده</h2>
<table>
    <thead>
    <tr>
        <th style="font-weight: bold">مجموع امتیاز پرداخت به موقع</th>
        <th style="font-weight: bold">کل پرداخت بابت هزینه های صندوق</th>
        <th style="font-weight: bold">کل بدهی</th>
        <th style="font-weight: bold">کل قرض الحسنه ضروری دریافتی</th>
        <th style="font-weight: bold">کل قرض الحسنه عادی دریافتی</th>
        <th style="font-weight: bold">سرمایه</th>
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
        <th style="font-weight: bold">بدهی قرض الحسنه جاری ضروری</th>
        <th style="font-weight: bold">قرض الحسنه جاری ضروری</th>
        <th style="font-weight: bold">بدهی قرض الحسنه جاری عادی</th>
        <th style="font-weight: bold">قرض الحسنه جاری عادی</th>
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
<br>
<br>
<br>
<h2>پرداخت ها</h2>
<table>
    <thead>
    <tr>
        <th style="font-weight: bold">تایید توسط</th>
        <th style="font-weight: bold">امتیاز پرداخت به موقع</th>
        <th style="font-weight: bold">توضیحات مدیر</th>
        <th style="font-weight: bold">توضیحات</th>
        <th style="font-weight: bold">سرمایه لحظه ای</th>
        <th style="font-weight: bold">مجموع پرداختی</th>
        <th style="font-weight: bold">پرداخت هزینه صندوق</th>
        <th style="font-weight: bold">پرداخت اقساط ضروری</th>
        <th style="font-weight: bold">پرداخت اقساط عادی</th>
        <th style="font-weight: bold">افزایش سرمایه</th>
        <th style="font-weight: bold">ثبت کننده</th>
        <th style="font-weight: bold">تاریخ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>
                @if ($payment->is_proved==0)
                    { تایید نشده }
                @else
                    {{$payment->proved_by}}
                @endif
            </td>
            <td>{{$payment->delay}}</td>
            <td>{{$payment->note}}</td>
            <td>{{$payment->description}}</td>
            <td>{{$payment->momentary}}</td>
            <td>{{$payment->sum}}</td>
            <td>{{$payment->payment_cost}}</td>
            <td>{{$payment->loan_payment_force}}</td>
            <td>{{$payment->loan_payment}}</td>
            <td>{{$payment->payment}}</td>
            <td>{{$payment->creator}}</td>
            <td>{{Str::before($payment->date_time,' ')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<br>
<br>
<h2>قرض الحسنه ها</h2>
<table>
    <thead>
    <tr>
        <th style="font-weight: bold">تاریخ تایید</th>
        <th style="font-weight: bold">تایید توسط</th>
        <th style="font-weight: bold">توضیحات مدیر</th>
        <th style="font-weight: bold">توضیحات</th>
        <th style="font-weight: bold">تاریخ مورد نیاز قرض الحسنه</th>
        <th style="font-weight: bold">مبلغ قرض الحسنه</th>
        <th style="font-weight: bold">نوع قرض الحسنه</th>
        <th style="font-weight: bold">ثبت کننده</th>
        <th style="font-weight: bold">تاریخ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>
                @if ($loan->is_proved==0)
                    { تایید نشده }
                @else
                    {{Str::before(Verta($loan->updated_at),' ')}}
                @endif
            </td>
            <td>
                @if ($loan->is_proved==0)
                    { تایید نشده }
                @else
                    {{$loan->proved_by}}
                @endif
            </td>
            <td>{{$loan->note}}</td>
            <td>{{$loan->description}}</td>
            <td>{{$loan->request_date}}</td>
            <td>{{$loan->loan}}</td>
            <td>
                @if($loan->force==0)
                    عادی
                @else
                    <span>ضروری</span>
                @endif
            </td>
            <td>{{$loan->creator}}</td>
            <td>{{Str::before($loan->date_time,' ')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<br>
<br>
<h2>درخواست ها</h2>
<table>
    <thead>
    <tr>
        <th style="font-weight: bold">توضیحات مدیر</th>
        <th style="font-weight: bold">متن درخواست - توضیحات</th>
        <th style="font-weight: bold">مبلغ درخواست</th>
        <th style="font-weight: bold">نوع درخواست</th>
        <th style="font-weight: bold">ثبت کننده</th>
        <th style="font-weight: bold">تاریخ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td>{{ $request->note }}</td>
            <td dir="rtl">
                @if($request->type==-1)
                    {{'لطفا مبلغ مزبور از محل سرمایه اینجانب پرداخت نمایید'.'-'.$request->description }}
                @elseif($request->type==0)
                    {{'لطفا حساب اینجانب بسته شود و تسویه حساب کامل صورت پذیرد.'.'-'.$request->description }}
                @endif
            </td>
            <td>
                @if($request->fee!=null)
                    {{ $request->fee }}
                @else
                    -
                @endif
            </td>
            <td>
                @if($request->type==-1)
                    برداشت از سرمایه
                @else
                    بستن حساب و تسویه
                @endif
            </td>
            <td>{{ $request->creator }}</td>
            <td>{{ Str::before($request->date_time,' ') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>