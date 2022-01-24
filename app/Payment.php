<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
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

    public function onlinepayment()
    {
        return $this->hasMany(Onlinepayment::class);
    }

    // scopes
    public function scopeProved(Builder $builder): Builder
    {
        return $builder->where('is_proved', '=', '1');
    }

    // accessors
    public function getSumAttribute()
    {
        return $this->loan_payment_force +
               $this->payment_cost +
               $this->loan_payment +
               $this->payment;
    }

    public function getPaymentCostAttribute()
    {
        return (int) $this->attributes['payment_cost'] ?? 0;
    }

    public function getLoanPaymentForceAttribute()
    {
        return (int) $this->attributes['loan_payment_force'] ?? 0;
    }

    public function getLoanPaymentAttribute()
    {
        return (int) $this->attributes['loan_payment'] ?? 0;
    }

    public function getPaymentAttribute()
    {
        return (int) $this->attributes['payment'] ?? 0;
    }
}
