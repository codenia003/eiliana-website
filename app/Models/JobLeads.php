<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLeads extends Model
{
    protected $table = 'job_leads';

    protected $primaryKey = 'job_leads_id';

    public function jobdetail()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'job_id');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }
}
