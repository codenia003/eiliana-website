<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Designation extends Model
{

    public $table = 'designations';

    protected $primaryKey = 'designation_id';

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
