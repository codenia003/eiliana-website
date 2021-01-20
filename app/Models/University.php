<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class University extends Model
{

    public $table = 'universities';
    protected $primaryKey = 'university_id';
    


    public $fillable = [
        'name',
        'town',
        'display_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'town' => 'string',
        'display_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'town' => 'required',
        'display_status' => 'required'
    ];
}
