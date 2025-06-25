<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    public function curriculum(){
        return $this->belongsTo('App\Curriculum');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

}
