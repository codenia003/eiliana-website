<?php

namespace App\Repositories;

use App\Models\EmployerType;
use InfyOm\Generator\Common\BaseRepository;

class EmployerTypeRepository extends BaseRepository
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
        return EmployerType::class;
    }
}
