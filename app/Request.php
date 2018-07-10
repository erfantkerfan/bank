<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id','type','fee','description','date_time','creator','note','is_proved','proved_by'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

}
