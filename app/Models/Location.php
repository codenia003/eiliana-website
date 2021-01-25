<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Location extends Model
{

    public $table = 'locations';
    protected $primaryKey = 'location_id';



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
