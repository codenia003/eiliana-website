<?php

namespace App\Repositories;

use App\Models\EducationType;
use InfyOm\Generator\Common\BaseRepository;

class EducationTypeRepository extends BaseRepository
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
        return EducationType::class;
    }
}
