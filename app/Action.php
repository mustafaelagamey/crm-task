<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    //

    // require pivot table
    public function customer(){
        return $this->belongsTo('App\Customer');
    }


    // require type_id
    public function type(){
        return $this->belongsTo('App\Type');
    }



}
