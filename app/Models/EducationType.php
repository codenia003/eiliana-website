<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class EducationType extends Model
{

    public $table = 'education_type';

    protected $primaryKey = 'education_type_id';


     protected $fillable = ['name'];

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
