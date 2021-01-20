<?php

namespace App\Repositories;

use App\Models\University;
use InfyOm\Generator\Common\BaseRepository;

class UniversityRepository extends BaseRepository
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
        return University::class;
    }
}
