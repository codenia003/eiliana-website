<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractualJobInform extends Model
{
    protected $table = 'contractual_job_inform';

    protected $primaryKey = 'contractual_job_id';

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
        return $this->belongsTo('App\Models\ContractualJobInform', 'job_id', 'job_id');
    }

    public function jobdetail()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'job_id');
    }
}
