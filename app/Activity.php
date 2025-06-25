<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function curriculum_subject(){
        return $this->belongsTo('App\CurriculumSubject');
    }
}
