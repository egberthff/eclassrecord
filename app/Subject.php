<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function curriculum(){
        return $this->belongsTo('App\Curriculum');
    }
}
