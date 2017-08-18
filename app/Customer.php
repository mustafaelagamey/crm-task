<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    //creating the relation employee customer (one to many)
    public function employee()
    {
        return $this->belongsTo('App\User','employee_id');
    }

    //creating the relation customer action (one to many)
    public function actions(){
        return $this->hasMany('App\Action');
    }
}
