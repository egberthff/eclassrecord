<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicPercentage  extends Model
{
    protected $table = 'dynamic_percentage';

    protected $fillable = [
        'curriculum_subject_id', 
        'attendance_percentage', 
        'quiz_percentage', 
        'course_term', 
        'schoolyear_id',
        'school_id',
        'course_id',
        'section_id',
        'semester',
        'teacher_id'
    ];
    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }
    public function course(){
        return $this->belongsTo('App\Course');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }
    public function curriculum(){
        return $this->belongsTo('App\Curriculum');
    }
   
    public function curriculum_subject(){
        return $this->belongsTo('App\CurriculumSubject');
    }

    // In app/Models/DynamicPercentage.php
public function scopeExcludePercentageAndName($query)
{
    return $query->select('id','attendance_percentage', 'quiz_percentage'); // select only the columns you want
}

}
