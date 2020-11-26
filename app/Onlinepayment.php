<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onlinepayment extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'payment_id','amount','authority','refid'
    ];
    public function members()
    {
        return $this->belongsTo(user::class, Payment::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
