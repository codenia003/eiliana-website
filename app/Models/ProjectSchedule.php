<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSchedule extends Model
{
    protected $table = 'project_schedules';

    protected $primaryKey = 'project_schedule_id';

    public function schedulemodulee()
    {
        return $this->hasMany('App\Models\ProjectScheduleModule', 'project_schedule_id', 'project_schedule_id');
    }
}
