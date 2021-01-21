<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Language extends Model
{

    public $table = 'languages';
    
    protected $primaryKey = 'language_id';
    


    public $fillable = [
        'name',
        'code',
        'display_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
        'display_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'code' => 'required',
        'display_status' => 'required'
    ];
}
