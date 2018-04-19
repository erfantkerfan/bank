<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password','acc_id','is_admin','is_super_admin','phone_number','faculty_number','home_number',
        'f_name','l_name','email','relation','note'.'user_note','instalment','instalment_force','period','period_force',
        'loan_row','loan_row_force','Cheque','Cheque_force'
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
            ->where('is_proved','=','1')->sum('payment');
        $summary['loans']= $this->hasMany(Loan::class)
            ->where('is_proved','=','1')->sum('loan');
        $summary['loan_payments']= $this->hasMany(Payment::class)
            ->where('is_proved','=','1')->sum('loan_payment');
        $summary['loan']= $this->hasMany(Loan::class)
            ->where('loan','!=',null)
            ->where('is_proved','=','1')
            ->latest()->get()->first();
        
        if ($summary['loan'] == null){
            $summary['loan']=0;
        }else{
            $summary['loan'] = $summary['loan']->loan;
        }

        $summary=(object)$summary;

        return $summary;
    }
}
