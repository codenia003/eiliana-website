<?php

namespace App\Repositories;

use App\Models\Currency;
use InfyOm\Generator\Common\BaseRepository;

class CurrencyRepository extends BaseRepository
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
        return Currency::class;
    }
}
