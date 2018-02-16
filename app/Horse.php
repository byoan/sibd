<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'race', 'description', 'price', 'experience', 'level', 'generalLevel'
    ];
}
