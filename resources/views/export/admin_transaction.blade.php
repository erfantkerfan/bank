<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
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
<h2 style="text-align: center;" dir="rtl">
    خلاصه تراکنش تمام اعضا
    {{$date}}
</h2>
<table class="table">
    <thead>
    <tr class="bg-info" dir="rtl">
        <th class="text-center">بدهی قرض الحسنه جاری ضروری</th>
        <th class="text-center">قرض الحسنه جاری ضروری</th>
        <th class="text-center">بدهی قرض الحسنه جاری عادی</th>
        <th class="text-center">قرض الحسنه جاری عادی</th>
        <th class="text-center">مجموع امتیاز پرداخت به موقع</th>
        <th class="text-center">کل پرداخت بابت هزینه های صندوق</th>
        <th class="text-center">کل بدهی</th>
        <th class="text-center">کل قرض الحسنه دریافتی</th>
        <th class="text-center">کل قرض الحسنه ضروری دریافتی</th>
        <th class="text-center">کل قرض الحسنه عادی دریافتی</th>
        <th class="text-center">سرمایه</th>
        <th class="text-center">شماره حساب</th>
        <th class="text-center">نام و نام خانوادگی</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr class="bg-warning">
            <td class="bg-danger text-center">{{number_format($user->summary->debt_force)}}</td>
            <td class="bg-danger text-center">
                @if(is_int($user->summary->loan_force))
                    {{number_format($user->summary->loan_force)}}
                @else
                    {{$user->summary->loan_force}}
                @endif
            </td>
            <td class="text-center">{{number_format($user->summary->debt)}}</td>
            <td class="text-center">
                @if(is_int($user->summary->loan))
                    {{number_format($user->summary->loan)}}
                @else
                    {{$user->summary->loan}}
                @endif
            </td>
            <td class="text-center">{{$user->delays()}}</td>
            <td class="text-center">{{number_format($user->summary->payments_cost)}}</td>
            <td class="text-center">{{number_format($user->summary->debt_all)}}
            <td class="text-center">{{number_format($user->summary->loans_all_all)}}</td>
            <td class="text-center">{{number_format($user->summary->loans_force_all)}}</td>
            <td class="text-center">{{number_format($user->summary->loans_all)}}</td>
            <td class="bg-success text-center">{{number_format($user->summary->payments)}}</td>
            <td class="bg-success text-center">{{$user->acc_id}}</td>
            <td class="bg-success text-center">{{$user->f_name.' '.$user->l_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>