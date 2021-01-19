<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerIndustry extends Model
{
    protected $table = 'customer_industry';

    protected $primaryKey = 'customer_industry_id';

    protected $fillable = ['name'];
}
