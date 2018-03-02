<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseasesList extends Model
{
    protected $fillable = [
        'idHorse', 'idDisease'
    ];
}
