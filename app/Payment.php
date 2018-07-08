<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class payment extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id','payment','payment_cost','loan_payment','loan_payment_force','description','date_time','is_proved',
        'proved_by','creator','delay','note'
    ];


    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public static function all_payment_summary()
    {
        $all_payment_summary['payments_p']= self::where('is_proved','=','1')->sum('payment');
        $all_payment_summary['payments_np']= self::where('is_proved','=','0')->sum('payment');
        $all_payment_summary['payments_cost_np']= self::where('is_proved','=','0')->sum('payment_cost');
        $all_payment_summary['loan_payments_p']= self::where('is_proved','=','1')->sum('loan_payment');
        $all_payment_summary['loan_payments_np']= self::where('is_proved','=','0')->sum('loan_payment');#
        $all_payment_summary['loan_payments_force_p']= self::where('is_proved','=','1')->sum('loan_payment_force');
        $all_payment_summary['loan_payments_force_np']= self::where('is_proved','=','0')->sum('loan_payment_force');#

        $all_payment_summary=(object)$all_payment_summary;

        return $all_payment_summary;
    }
}
