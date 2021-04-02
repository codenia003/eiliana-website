<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveJob extends Model
{
    protected $table = 'save_job';

    protected $primaryKey = 'id';

    public function jobdetail()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'job_id');
    }
}
