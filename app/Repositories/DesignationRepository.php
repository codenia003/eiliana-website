<?php

namespace App\Repositories;

use App\Models\Designation;
use InfyOm\Generator\Common\BaseRepository;

class DesignationRepository extends BaseRepository
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
        return Designation::class;
    }
}
