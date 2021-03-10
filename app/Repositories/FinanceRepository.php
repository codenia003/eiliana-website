<?php

namespace App\Repositories;

use App\Models\Finance;
use InfyOm\Generator\Common\BaseRepository;

class FinanceRepository extends BaseRepository
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
        return Finance::class;
    }
}