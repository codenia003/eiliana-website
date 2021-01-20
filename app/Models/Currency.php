<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Currency extends Model
{

    public $table = 'currencies';
    protected $primaryKey = 'currency_id';
    


    public $fillable = [
        'title',
        'code',
        'symbol',
        'display_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'code' => 'string',
        'symbol' => 'string',
        'display_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'code' => 'required',
        'symbol' => 'required',
        'display_status' => 'required'
    ];
}
