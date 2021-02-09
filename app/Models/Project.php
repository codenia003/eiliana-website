<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    
    protected $primaryKey = 'project_id';

    const CREATED_AT = 'post_datetime';

    public function companydetails()
    {
        return $this->belongsTo('App\Models\User', 'posted_by_user_id', 'id');
    }

}
