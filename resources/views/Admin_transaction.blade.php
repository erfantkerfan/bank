@extends('layouts.app')

@section('content')
    <script>
        function numberWithCommas() {
            var1 = parseInt(document.getElementById('payment').value.replace(/,/g, ''))||0 ;
            if(document.getElementById("negative")){
                if(document.getElementById('negative').checked){
                    var1 = -var1
                }
            }
            var2 = parseInt(document.getElementById('loan_payment').value.replace(/,/g, ''))||0 ;
            var3 = parseInt(document.getElementById('loan_payment_force').value.replace(/,/g, ''))||0 ;
            var4 = parseInt(document.getElementById('payment_cost').value.replace(/,/g, ''))||0 ;
            x = var1 + var2 + var3 + var4
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1,$2");
            return x;
        }
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <div class="container text-center">
        <div class="row">
            @foreach($users as $user)
                <div class="panel panel-primary">
                    <div class="panel-heading text-center" dir="rtl">
                        خلاصه وضعیت
                        <a href="{{ route('user',['id'=>$user->id]) }}" style="color: black;">{{$user->f_name.' '.$user->l_name}}</a>
                        -
                        شماره حساب
                        {{$user->acc_id}}
                        <a href="{{route('user_edit',['id' => $user->id])}}">
                            <button type="button" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-cog" style="color:darkblue"></span>
                            </button>
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">مجموع امتیاز پرداخت به موقع</th>
                                <th class="text-center">کل پرداخت بابت هزینه های صندوق</th>
                                <th class="text-center">کل بدهی</th>
                                <th class="text-center">کل قرض الحسنه ضروری دریافتی</th>
                                <th class="text-center">کل قرض الحسنه عادی دریافتی</th>
                                <th class="text-center">سرمایه</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-warning">
                                <td class="text-center">{{$user->delays()}}</td>
                                <td class="text-center">{{number_format($user->summary->payments_cost)}}</td>
                                <td class="text-center">{{number_format($user->summary->debt_force+$user->summary->debt)}}
                                <td class="text-center">{{number_format($user->summary->loans_force_all)}}</td>
                                <td class="text-center">{{number_format($user->summary->loans_all)}}</td>
                                <td class="bg-success text-center">{{number_format($user->summary->payments)}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">بدهی قرض الحسنه جاری ضروری</th>
                                <th class="text-center">قرض الحسنه جاری ضروری</th>
                                <th class="text-center">بدهی قرض الحسنه جاری عادی</th>
                                <th class="text-center">قرض الحسنه جاری عادی</th>
                            </tr>
                            </thead>
                            <tbody>
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
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection