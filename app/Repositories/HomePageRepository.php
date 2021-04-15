<?php

namespace App\Repositories;

use App\Models\HomePage;
use InfyOm\Generator\Common\BaseRepository;

class HomePageRepository extends BaseRepository
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
        return HomePage::class;
    }
}
