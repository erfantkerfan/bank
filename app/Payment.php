<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class payment extends Model
{

    protected $fillable = [
        'user_id','payment','loan_payment','description','date_time','is_proved','proved_by'
    ];


    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public static function all_payment_summary()
    {
        $all_payment_summary['payments_p']= self::where('is_proved','=','1')->sum('payment');
        $all_payment_summary['payments_np']= self::where('is_proved','=','0')->sum('payment');
        $all_payment_summary['loan_payments_p']= self::where('is_proved','=','1')->sum('loan_payment');
        $all_payment_summary['loan_payments_np']= self::where('is_proved','=','0')->sum('loan_payment');
        $all_payment_summary=(object)$all_payment_summary;

        return $all_payment_summary;
    }
}
