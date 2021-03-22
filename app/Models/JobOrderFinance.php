<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderFinance extends Model
{
    protected $table = 'job_order_finance';

    protected $primaryKey = 'job_order_id';


    public function userjobs()
    {
         return $this->belongsTo('App\Models\Job', 'job_id', 'job_id');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function jobAmount()
    {
        return $this->belongsTo('App\Models\ContractualJobInform', 'job_id', 'job_id');
    }

}
