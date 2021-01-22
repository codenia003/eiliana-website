<?php

namespace App\Repositories;

use App\Models\CandidateRole;
use InfyOm\Generator\Common\BaseRepository;

class CandidateRoleRepository extends BaseRepository
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
        return CandidateRole::class;
    }
}
