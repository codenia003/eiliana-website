<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employers extends Model
{
    protected $table = 'employers';
    
    protected $primaryKey = 'employer_id';

     public function designationtype()
    {
        return $this->belongsTo('App\Models\Designation', 'designation', 'designation_id');
    }

    public function employertype()
    {
        return $this->belongsTo('App\Models\EmployerType', 'employment_type', 'employer_type_id');
    }
}
