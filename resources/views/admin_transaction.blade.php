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
    <div class="container-fluid text-center">
        <div class="row">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center" dir="rtl">
                        مدیریت خلاصه تراکنش ها
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr class="bg-info" dir="rtl">
                                <th class="text-center">
                                    بدهی قرض الحسنه جاری ضروری
                                    <a href="{{ route('admin_transaction',array('sort'=>'debt_force')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    قرض الحسنه جاری ضروری
                                    <a href="{{ route('admin_transaction',array('sort'=>'loan_force')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    بدهی قرض الحسنه جاری عادی
                                    <a href="{{ route('admin_transaction',array('sort'=>'debt')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    قرض الحسنه جاری عادی
                                    <a href="{{ route('admin_transaction',array('sort'=>'loan')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    مجموع امتیاز پرداخت به موقع
                                    <a href="{{ route('admin_transaction',array('sort'=>'delays')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    کل پرداخت بابت هزینه های صندوق
                                    <a href="{{ route('admin_transaction',array('sort'=>'payments_cost')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    کل بدهی
                                    <a href="{{ route('admin_transaction',array('sort'=>'debt_all')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    کل قرض الحسنه دریافتی
                                    <a href="{{ route('admin_transaction',array('sort'=>'loans_all_all')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    کل قرض الحسنه ضروری دریافتی
                                    <a href="{{ route('admin_transaction',array('sort'=>'loans_force_all')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    کل قرض الحسنه عادی دریافتی
                                    <a href="{{ route('admin_transaction',array('sort'=>'loans_all')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    سرمایه
                                    <a href="{{ route('admin_transaction',array('sort'=>'payments')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">
                                    شماره حساب
                                    <a href="{{ route('admin_transaction') }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </button>
                                    </a>
                                </th>
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
                                <td class="bg-success text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name.' '.$user->l_name}}</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection