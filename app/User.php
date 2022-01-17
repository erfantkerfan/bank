<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
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

    public function summary()
    {
        $summary['payments']= $this->totalPayments();

        $summary['payments_cost']= $this->Payment
            ->where('is_proved','=','1')
            ->sum('payment_cost');
        $summary['loans_all']= $this->Loan
            ->where('is_proved','=','1')
            ->where('force','=','0')
            ->sum('loan');
        $summary['loans_force_all']= $this->Loan
            ->where('is_proved','=','1')
            ->where('force','=','1')
            ->sum('loan');
        $summary['loans_all_all'] = $summary['loans_force_all'] + $summary['loans_all'] ;
        $summary['loan']= $this->Loan
            ->where('is_proved','=','1')
            ->where('force','=','0')
            ->first();
        $summary['loan_force']= $this->Loan
            ->where('is_proved','=','1')
            ->where('force','=','1')
            ->first();
        $summary['debt']= $this->Loan
            ->where('is_proved','=','1')
            ->where('force','=','0')
            ->sum('loan')
            -
            $this->Payment
            ->where('is_proved','=','1')
            ->sum('loan_payment');
        $summary['debt_force']=
            $this->Loan
            ->where('is_proved','=','1')
            ->where('force','=','1')
            ->sum('loan')
            -
            $this->Payment
            ->where('is_proved','=','1')
            ->sum('loan_payment_force');

        if ($summary['loan'] == null){
            $summary['loan']=0;
        }else{
            $summary['loan'] = $summary['loan']->loan;
        }
        if($summary['debt']==0){
            $summary['loan']='تسویه شده';
        }


        if ($summary['loan_force'] == null){
            $summary['loan_force']=0;
        }else{
            $summary['loan_force'] = $summary['loan_force']->loan;
        }
        if($summary['debt_force']==0){
            $summary['loan_force']='تسویه شده';
        }

        $summary=(object)$summary;

        return $summary;
    }

    public function addTotalPayment():void
    {
        $this->payments_cost = array_sum($this->payment->pluck('payment_cost')->toArray());
    }

    public function totalPayments()
    {
        return $this->Payment()->where('is_proved','=','1')
            ->sum('payment');
    }
}
