<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ProjectStatus extends Model
{

    public $table = 'project_status';
    
     protected $primaryKey = 'project_status_id';


    public $fillable = [
        'project_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'project_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'project_status' => 'required'
    ];
}
