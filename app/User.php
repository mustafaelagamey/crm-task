<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //creating the relation role user  (one to many)
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    //creating the relation employee customer (one to many)
    public function customers()
    {
        return $this->hasMany('App\Customer','employee_id');
    }

}
