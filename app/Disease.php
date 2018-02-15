<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'typeDisease', 'description'
    ];
}
