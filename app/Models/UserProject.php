<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_projects';

    protected $primaryKey = 'user_project_id';

    public function projecttypes()
    {
        return $this->belongsTo('App\Models\ProjectType', 'project_type', 'project_type_id');
    }

    public function technologuname()
    {
        return $this->belongsTo('App\Models\Technology', 'technologty_pre', 'technology_id');
    }

    public function frameworkname()
    {
        return $this->belongsTo('App\Models\Technology', 'framework', 'technology_id');
    }

    public function customerindustry()
    {
        return $this->belongsTo('App\Models\CustomerIndustry', 'industry', 'customer_industry_id');
    }

    public function employername()
    {
        return $this->belongsTo('App\Models\Employers', 'employer_id', 'employer_id');
    }

    
}
