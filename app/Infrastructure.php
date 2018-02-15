<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'level', 'description', 'itemCapacity', 'horseCapacity', 'itemList', 'family', 'price', 'ressourcesConsumption'
    ];
}
