<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function projectamount()
    {
        return $this->belongsTo('App\Models\ProjectBudgetAmount', 'project_id', 'project_id');
    }

    public function projectCurrency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id', 'currency_id');
    }

    public function customerindustry1()
    {
        return $this->belongsTo('App\Models\CustomerIndustry', 'customer_industry', 'customer_industry_id');
    }
    
    public function projectsubcategory()
    {
        return $this->belongsTo('App\Models\ProjectCategory', 'project_sub_category', 'id');
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

    public function scopeExpire($query)
    {
        return $query->where('expiry_datetime', '>', Carbon::now());
    }

    public function scopeActive($query, $value)
    {
        return $query->where('project_status_id', '=', $value);
    }

    public function projectdetail()
    {
        return $this->belongsTo('App\Models\ProjectLeads', 'project_id', 'project_id');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function technologys()
    {
        return $this->belongsTo('App\Models\Technology', 'technologty_pre', 'technology_id');
    }
}
