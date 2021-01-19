<?php

namespace App\Repositories;

use App\Models\ProjectStatus;
use InfyOm\Generator\Common\BaseRepository;

class ProjectStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectStatus::class;
    }
}
