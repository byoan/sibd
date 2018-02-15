<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoTask extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'idUser', 'id');
    }
}
