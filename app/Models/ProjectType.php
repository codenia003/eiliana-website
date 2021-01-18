<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $table = 'project_type';

    protected $primaryKey = 'project_type_id';

    protected $fillable = ['name'];
}
