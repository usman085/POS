<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    
    /**
    * All attributes  must  have value 
    * 
    *
    */
    protected $fillable = 
    [
       'program_title','program_short_title','program_duration','no_of_semester', 
    ];
    
    /**
    * Programs has Many Courses
    * 
    *
    */
    public function AssignedCourses()
    {
        return $this->belongsToMany('App\Models\Course')->withPivot('semester')->withPivot('id');
    }

    /**
    * Program has Many relationship with  Student Official Detail
    * 
    *
    */
    public function studentOfficialDetail()
    {
        return $this->hasMany('App\Models\StudentOfficialDetail');
    }

    /**
    * Program has Many relationship with  Exam Routine    * 
    *
    */
    public function examRoutine()
    {
        return $this->hasMany('App\Models\ExamRoutine');
    }
}
