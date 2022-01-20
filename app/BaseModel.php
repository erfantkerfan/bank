<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function scopeAggregate(Builder $builder, string $aggregateFunction, string $field)
    {
        return $builder->{$aggregateFunction}($field);
    }
}