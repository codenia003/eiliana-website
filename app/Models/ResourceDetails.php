<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceDetails extends Model
{
    protected $table = 'resource_details';

    protected $primaryKey = 'resource_id';


    public function jobcontractschedule()
    {
        return $this->hasOne('App\Models\ContractualJobSchedule', 'job_schedule_id', 'job_schedule_id');
    }

}
