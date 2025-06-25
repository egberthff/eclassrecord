<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function schoolyear(){
        return $this->belongsTo('App\Schoolyear');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function user(){
        return $this->hasOne('App\User', 'email', 'id_no');
    }
}
