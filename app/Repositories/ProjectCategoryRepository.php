<?php

namespace App\Repositories;

use App\Models\ProjectCategory;
use InfyOm\Generator\Common\BaseRepository;

class ProjectCategoryRepository extends BaseRepository
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
        return ProjectCategory::class;
    }
}
