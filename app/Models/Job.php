<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $primaryKey = 'job_id';

    protected $guarded = [];

    public function companydetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function locations()
    {
        return $this->belongsTo('App\Models\Location', 'location', 'location_id');
    }

    public function jobseducation()
    {
        return $this->hasMany('App\Models\JobsEducation', 'job_id', 'job_id');
    }

    public function jobscertificate()
    {
        return $this->hasMany('App\Models\JobsCertificate', 'job_id', 'job_id');
    }

    public function jobsquestion()
    {
        return $this->hasMany('App\Models\JobsQuestion', 'job_id', 'job_id');
    }

    public function jobleadresponse()
    {
        return $this->hasMany('App\Models\JobLeads', 'job_id', 'job_id');
    }

    public function by_user_job()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function customerindustry1()
    {
        return $this->belongsTo('App\Models\CustomerIndustry', 'customer_industry', 'customer_industry_id');
    }
}
