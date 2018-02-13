<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoTask extends Model
{
    public function user()
    {
        $this->belongsTo('App\User');
    }
}
