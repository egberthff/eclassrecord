<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public function courses(){
        return $this->hasMany('App\Course');
    }
}
