<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoTask extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'action', 'frequency', 'idObject', 'idUser'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'idUser', 'id');
    }
}
