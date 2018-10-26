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
    public function payment()
    {
        return $this->belongsTo(payment::class);
    }
}
