<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'type', 'level', 'description', 'price', 'family'
    ];
}
