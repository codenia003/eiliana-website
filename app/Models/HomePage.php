<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    public $table = 'home_page';
    protected $primaryKey = 'id';
    

    public $fillable = [
        'title', 'description', 'keywords', 'active'
    ];
}
