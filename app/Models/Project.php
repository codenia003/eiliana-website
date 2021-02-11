<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    
    protected $primaryKey = 'project_id';

    const CREATED_AT = 'post_datetime';

    public function companydetails()
    {
        return $this->belongsTo('App\Models\User', 'posted_by_user_id', 'id');
    }
    
    public function locations()
    {
        return $this->belongsTo('App\Models\Location', 'location', 'location_id');
    }

     public function projectseducation()
    {
        return $this->hasMany('App\Models\ProjectsEducation', 'project_id', 'project_id');
    }

    public function projectscertificate()
    {
        return $this->hasMany('App\Models\ProjectsCertificate', 'project_id', 'project_id');
    }

    public function projectsquestion()
    {
        return $this->hasMany('App\Models\ProjectsQuestion', 'project_id', 'project_id');
    }

    public function projectbidresponse()
    {
        return $this->hasMany('App\Models\ProjectLeads', 'project_id', 'project_id');
    }
}
