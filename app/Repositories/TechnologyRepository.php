<?php

namespace App\Repositories;

use App\Models\Technology;
use InfyOm\Generator\Common\BaseRepository;

class TechnologyRepository extends BaseRepository
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
        return Technology::class;
    }
}
