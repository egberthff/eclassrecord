<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCoordinator extends Model
{
    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }
}
