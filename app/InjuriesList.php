<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InjuriesList extends Model
{
    protected $fillable = [
        'idHorse', 'idInjury'
    ];
}
