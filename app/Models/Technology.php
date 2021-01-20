<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Technology extends Model
{

    public $table = 'technologies';

    protected $primaryKey = 'technology_id';

    public $fillable = [
        'parent_id',
        'technology_name',
        'display_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'string',
        'technology_name' => 'string',
        'display_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'required',
        'technology_name' => 'required',
        'display_status' => 'required'
    ];
}
