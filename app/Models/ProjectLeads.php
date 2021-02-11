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

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }
}
