@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">خلاصه وضعیت صندوق</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr class="bg-info">
                                    <th class="text-center">کل بدهی</th>
                                    <th class="text-center">بدهی قرض الحسنه ضروری</th>
                                    <th class="text-center">قرض الحسنه ضروری</th>
                                    <th class="text-center">بدهی قرض الحسنه عادی</th>
                                    <th class="text-center">قرض الحسنه عادی</th>
                                    <th class="text-center">موجودی صندوق</th>
                                    <th class="text-center">سرمایه</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-success">
                                    <td class="text-center">{{number_format($all_loan_summary->loans_force_p-$all_payment_summary->loan_payments_force_p+$all_loan_summary->loans_p-$all_payment_summary->loan_payments_p)}}</td>
                                    <td class="text-center">{{number_format($all_loan_summary->loans_force_p-$all_payment_summary->loan_payments_force_p)}}</td>
                                    <td class="text-center">{{number_format($all_loan_summary->loans_force_p)}}</td>
                                    <td class="text-center">{{number_format($all_loan_summary->loans_p-$all_payment_summary->loan_payments_p)}}</td>
                                    <td class="text-center">{{number_format($all_loan_summary->loans_p)}}</td>
                                    <td class="text-center">{{number_format($all_payment_summary->payments_p-($all_loan_summary->loans_force_p-$all_payment_summary->loan_payments_force_p+$all_loan_summary->loans_p-$all_payment_summary->loan_payments_p))}}</td>
                                    <td class="text-center">{{number_format($all_payment_summary->payments_p)}}</th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">قرض الحسنه ضروری درخواستی</th>
                                <th class="text-center">قرض الحسنه عادی درخواستی</th>
                                <th class="text-center">هزینه های پرداختی</th>
                                <th class="text-center">واریز اقساط ضروری</th>
                                <th class="text-center">واریز اقساط عادی</th>
                                <th class="text-center">افزایش سرمایه</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-danger">
                                <td class="text-center">{{number_format($all_loan_summary->loans_force_np)}}</td>
                                <td class="text-center">{{number_format($all_loan_summary->loans_np)}}</td>
                                <td class="text-center">{{number_format($all_payment_summary->payments_cost_np)}}</td>
                                <td class="text-center">{{number_format($all_payment_summary->loan_payments_force_np)}}</td>
                                <td class="text-center">{{number_format($all_payment_summary->loan_payments_np)}}</td>
                                <td colspan="2" class="text-center">{{number_format($all_payment_summary->payments_np)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        ( لیست اعضا
                        ( تعداد اعضا
                        {{ $users->count() }}
                        <span class="glyphicon glyphicon glyphicon-minus"></span>
                        تعداد اعضای فعال
                        {{ $users->where('active','==','1')->count() }}
                    </div>
                    <div class="panel-body bg-success">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">ویرایش اطلاعات</th>
                                <th class="text-center">دسترسی مدیریتی</th>
                                <th class="text-center">دسترسی بازرسی</th>
                                <th class="text-center">عضو فعال</th>
                                <th class="text-center">
                                    آخرین فعالیت
                                    <a href="{{ route('admin',array('sort'=>'new_login','sort_order'=>'desc')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">ارتباط با عضو دیگر</th>
                                <th class="text-center">
                                    شماره حساب
                                    <a href="{{ route('admin',array('sort'=>'acc_id')) }}">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                        </button>
                                    </a>
                                </th>
                                <th class="text-center">نام کاربری</th>
                                <th class="text-center">نام خانوادگی</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th class="text-center">
                                        <a href="{{route('user_edit',['id' => $user->id])}}">
                                            <button type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-cog" style="color:darkblue"></span>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="text-center">
                                        @if ($user->is_super_admin==0)
                                            <span class="glyphicon glyphicon-remove" style="color:red"></span>
                                        @elseif ($user->is_super_admin==1)
                                            <span class="glyphicon glyphicon-ok" style="color:green"></span>
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if ($user->is_admin==0)
                                            <span class="glyphicon glyphicon-remove" style="color:red"></span>
                                        @elseif ($user->is_admin==1)
                                            <span class="glyphicon glyphicon-ok" style="color:green"></span>
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if ($user->active==0)
                                            <span class="glyphicon glyphicon-remove" style="color:red"></span>
                                        @elseif ($user->active==1)
                                            <span class="glyphicon glyphicon-ok" style="color:green"></span>
                                        @endif
                                    </th>
{{--                                    <th class="text-center">{{Str::replaceArray(' ',['   '],str_replace('-','/',$user->new_login))}}</th>--}}
                                    <th class="text-center" dir="rtl">{{$user->new_login ? Verta::parse($user->new_login)->formatDifference(\Hekmatinasser\Verta\Verta::now()) : "تا به حال لاگین نشده"}}</th>
                                    <th class="text-center" dir="rtl">{{$user->relation}}</th>
                                    <th class="text-center">{{$user->acc_id}}</th>
                                    <th class="text-center">{{$user->username}}</th>
                                    <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->l_name}}</a></th>
                                    <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name}}</a></th>
                                    <th class="text-center">{{$loop->iteration}}</th>
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