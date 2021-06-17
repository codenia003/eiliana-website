<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesReferral extends Model
{
    protected $table = 'sales_referral';

    protected $primaryKey = 'sales_referral_id';

    protected $guarded = [];

    public function companydetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
