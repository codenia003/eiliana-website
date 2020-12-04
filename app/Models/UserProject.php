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
}
