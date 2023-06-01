<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    protected $casts = ['deleted_at'];

    protected $fillable = [
        'user_id','expense','description','date_time',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}