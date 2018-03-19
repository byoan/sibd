<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorseIndicator extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idHorse', 'idIndicator'
    ];
}
