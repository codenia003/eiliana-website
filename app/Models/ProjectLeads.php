<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLeads extends Model
{
    protected $table = 'project_leads';

    protected $primaryKey = 'project_leads_id';

    public function projectdetail()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'project_id');
    }

    public function touser()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id', 'id');
    }
}
