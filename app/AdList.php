<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdList extends Model
{
    protected $fillable = [
        'idNewspaper', 'idAd'
    ];
}
