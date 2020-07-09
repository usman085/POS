<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
     protected $fillable =[ 'id','guardian_name'];

       /**
     *  Guardian relationship with student.
     */
    public function studentPersonalDetail()
    {
        return $this->hasMany('App\Models\StudentPersonalDetail');
    }
}
