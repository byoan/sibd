<?php

namespace App;

use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstName', 'lastName', 'email', 'password', 'role', 'description', 'address', 'phone', 'website', 'sex', 'birthDate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Getter for the user role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->hasOne('App\Role', 'id', 'role');
    }

    /**
     * Checks if the user's role is allowed to perform the received action
     * on the received target according to the configuration file permissions.php
     *
     * @param array $actions The action(s) to perform, such as select, update or delete
     * @param string $target The target table, such as horse or user
     * @return boolean
     *
     * @throws \Exception In case the user role isn't defined in the configuration file
     */
    public function hasPermission(array $actions, string $target)
    {
        $rolePermissions = Config::get('permissions.' . Role::find($this->role)->name);
        if (!empty($rolePermissions)) {
            foreach ($actions as $action) {
                if (!isset($rolePermissions[$target]) || !in_array($action, $rolePermissions[$target]) && !$rolePermissions == '*') {
                    abort(403, 'You are not allowed to access this page');
                }
            }
        } else {
            throw new \Exception('Invalid user role');
        }
    }

    public function account()
    {
        return $this->hasOne('App\Account', 'id', 'idAccount');
    }

    public function planning()
    {
        return $this->hasMany('App\AutoTask', 'idUser', 'id');
    }
}
