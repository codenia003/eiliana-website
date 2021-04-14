<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ProjectCategory extends Model
{

    public $table = 'project_category';
     protected $primaryKey = 'id';
    

    public $fillable = [
        'name', 'parent_id', 'heading', 'descriptor', 'slug', 'keywords'
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
