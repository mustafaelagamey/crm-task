<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function employee()
    {
        return $this->belongsTo('App\User','employee_id');
    }

    public function actions(){
        return $this->hasMany('App\Action');
    }
}
