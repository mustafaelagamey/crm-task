<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    //creating the relation role user  (one to many)

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
