<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobContractDetails extends Model
{
    protected $table = 'job_contract_details';

    protected $primaryKey = 'contract_id';

    public function joborderinvoice()
    {
        return $this->hasOne('App\Models\JobOrderInvoice', 'contract_id', 'contract_id');
    }

    public function jobpaymentschedule()
    {
        return $this->hasMany('App\Models\JobPaymentSchedule', 'job_leads_id', 'job_leads_id');
    }

    public function jobadvacne_amount() {
        return $this->jobpaymentschedule()->where('advance_payment','=', '1');
    }
}
