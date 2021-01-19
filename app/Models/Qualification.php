<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Qualification extends Model
{

    public $table = 'qualifications';
    
    protected $primaryKey = 'qualification_id';

    public $fillable = [
        'name',
        'type',
        'display_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string',
        'display_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'type' => 'required',
        'display_status' => 'required'
    ];
}
