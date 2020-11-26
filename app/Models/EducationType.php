<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationType extends Model
{
    protected $table = 'education_type';
    
    protected $primaryKey = 'education_type_id';

    protected $fillable = ['name'];

}
