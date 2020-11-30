<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = 'qualifications';
    
    protected $primaryKey = 'qualification_id';

    protected $fillable = ['name'];
}
