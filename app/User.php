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
        'loan_row','loan_row_force','cheque','cheque_force'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Loan()
    {
        return $this->hasMany(Loan::class)->orderBy('date_time','desc');
    }

    public function Payment()
    {
        return $this->hasMany(Payment::class)->orderBy('date_time','desc');
    }

    public function summary()
    {
        $summary['payments']= $this->hasMany(Payment::class)
            ->where('is_proved','=','1')
            ->sum('payment');
        $summary['payments_cost']= $this->hasMany(Payment::class)
            ->where('is_proved','=','1')
            ->sum('payment_cost');
        $summary['loans_all']= $this->hasMany(Loan::class)
            ->where('is_proved','=','1')
            ->sum('loan');
        $summary['loan']= $this->hasMany(Loan::class)
            ->where('is_proved','=','1')
            ->where('force','=','0')
            ->latest()->get()->first();
        $summary['loan_force']= $this->hasMany(Loan::class)
            ->where('is_proved','=','1')
            ->where('force','=','1')
            ->latest()->get()->first();
        $summary['debt']=
            $this->hasMany(Loan::class)
            ->where('is_proved','=','1')
            ->where('force','=','0')
            ->sum('loan')
            -
            $this->hasMany(Payment::class)
            ->where('is_proved','=','1')
            ->sum('loan_payment');
        $summary['debt_force']=
            $this->hasMany(Loan::class)
            ->where('is_proved','=','1')
            ->where('force','=','1')
            ->sum('loan')
            -
            $this->hasMany(Payment::class)
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
}
