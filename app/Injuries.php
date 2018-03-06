<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Injuries extends Model
{
    protected $fillable = [
        'typeInjury', 'description'
    ];
}
