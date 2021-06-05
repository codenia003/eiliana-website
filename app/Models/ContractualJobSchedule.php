<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractualJobSchedule extends Model
{
     protected $table = 'contractual_job_schedule';

    protected $primaryKey = 'job_schedule_id';

    public function userjobs()
    {
         return $this->belongsTo('App\Models\JobLeads', 'job_leads_id', 'job_leads_id');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function jobAmount()
    {
        return $this->belongsTo('App\Models\ContractualJobSchedule', 'job_id', 'job_id');
    }

    public function jobdetail()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'job_id');
    }

    public function locations()
    {
        return $this->belongsTo('App\Models\Location', 'location', 'location_id');
    }

    public function joblead()
    {
        return $this->belongsTo('App\Models\JobLeads', 'job_leads_id', 'job_leads_id');
    }

}
