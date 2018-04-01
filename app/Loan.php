<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class loan extends Model
{

    protected $fillable = [
        'user_id','loan','description','date_time','force','is_proved','proved_by'
    ];


    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public static function all_loan_summary()
    {
        $all_loan_summary['loans_p']= self::where('is_proved','=','1')->sum('loan');
        $all_loan_summary['loans_np']= self::where('is_proved','=','0')->sum('loan');
        $all_loan_summary=(object)$all_loan_summary;

        return $all_loan_summary;
    }
}
