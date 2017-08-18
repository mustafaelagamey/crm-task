<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    //

    //creating the relation customer action (one to many)
    public function customer(){
        return $this->belongsTo('App\Customer');
    }


    //creating the relation  type action  (one to many)
    public function type(){
        return $this->belongsTo('App\Type');
    }



}
