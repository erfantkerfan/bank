<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Verta;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $guarded = ['id'];
    protected $casts = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password','acc_id','is_admin','is_super_admin','phone_number','faculty_number','home_number',
        'f_name','l_name','email','relation','note'.'user_note','instalment','instalment_force','period','period_force',
        'loan_row','loan_row_force','cheque','cheque_force','start_date','end_date','start_date_force','end_date_force',
        'new_login','old_login','active','user_note_date','note_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function delays()
    {
        return $this->Payment->sum('delay');
    }

    public function Loan()
    {
        return $this->hasMany(Loan::class)->orderBy('date_time','desc');
    }

    public function request()
    {
        return $this->hasMany(Request::class)->orderBy('date_time','desc');
    }

    public function Payment()
    {
        return $this->hasMany(Payment::class)->orderBy('date_time','desc');
    }

    public function recentPayments()
    {
        return $this->hasMany(Payment::class)->Proved()->where('date_time', '>', new Verta('-30 day'))->orderBy('date_time','desc');
    }

    public function summary()
    {
        $provedPayments = $this->Payment()->proved()->get();
        $notForceProvedLoans = $this->Loan()->proved()->notForce()->get();
        $forceProvedLoans = $this->Loan()->proved()->force()->get();

        $summary['payments']= $provedPayments->sum('payment');

        $summary['payments_cost']=  $provedPayments->sum('payment_cost');

        $summary['loans_all']= $notForceProvedLoans->sum('loan');

        $summary['loans_force_all']= $forceProvedLoans->sum('loan');

        $summary['loans_all_all'] = $summary['loans_force_all'] + $summary['loans_all'] ;

        $summary['loan']= $notForceProvedLoans->first()?->loan ?? 0;

        $summary['loan_force']= $forceProvedLoans->first()?->loan ?? 0;

        $summary['debt']= $summary['loans_all'] - $provedPayments->sum('loan_payment');

        $summary['debt_force']=$summary['loans_force_all'] - $provedPayments->sum('loan_payment_force');

        if($summary['debt']==0){
            $summary['loan']='تسویه شده';
        }

        if($summary['debt_force']==0){
            $summary['loan_force']='تسویه شده';
        }

        return (object)$summary;
    }

    public function addTotalPayment():void
    {
        $this->payments_cost = array_sum($this->payment->pluck('payment_cost')->toArray());
    }
}
