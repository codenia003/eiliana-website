<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectScheduleModule extends Model
{
    protected $table = 'project_schedule_modules';

    protected $primaryKey = 'project_schedule_module_id';

    public function subschedulemodulee()
    {
        return $this->hasMany('App\Models\ProjectSubScheduleModule', 'project_schedule_module_id', 'project_schedule_module_id');
    }
}
