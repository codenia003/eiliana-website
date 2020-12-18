<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerType extends Model
{
    protected $table = 'employer_type';
    
    protected $primaryKey = 'employer_type_id';

    protected $fillable = ['name'];
}
