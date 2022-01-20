<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id','loan','description','date_time','force','is_proved','proved_by','creator','request_date','note'
    ];


    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public static function all_loan_summary()
    {
        $all_loan_summary['loans_p']= self::where('is_proved','=','1')->where('force','=','0')->sum('loan');
        $all_loan_summary['loans_np']= self::where('is_proved','=','0')->where('force','=','0')->sum('loan');
        $all_loan_summary['loans_force_p']= self::where('is_proved','=','1')->where('force','=','1')->sum('loan');
        $all_loan_summary['loans_force_np']= self::where('is_proved','=','0')->where('force','=','1')->sum('loan');

        $all_loan_summary=(object)$all_loan_summary;

        return $all_loan_summary;
    }

    //scopes
    public function scopeProved(Builder $builder):Builder
    {
        return $builder->where('is_proved','=','1');
    }

    public function scopeNotForce(Builder $builder):Builder
    {
        return $builder->where('force','=','0');
    }

    public function scopeForce(Builder $builder):Builder
    {
        return $builder->where('force','=','1');
    }

}
