<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class CandidateRole extends Model
{

    public $table = 'candidate_roles';

     protected $primaryKey = 'candidate_role_id';
    


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];
}
