<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'IdUser','horseList','itemList','infraList','ridingStableList','horseClubList'
    ];
}
