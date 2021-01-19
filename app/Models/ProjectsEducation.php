<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsEducation extends Model
{
    protected $table = 'jobs_education';

    protected $primaryKey = 'education_id';

    public function educationtype()
    {
        return $this->belongsTo('App\Models\EducationType', 'education_type', 'education_type_id');
    }

    public function university()
    {
        return $this->belongsTo('App\Models\University', 'name', 'university_id');
    }

    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification', 'degree', 'qualification_id');
    }
}
