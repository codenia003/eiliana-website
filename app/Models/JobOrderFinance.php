<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderFinance extends Model
{
    protected $table = 'job_order_finance';

    protected $primaryKey = 'job_order_id';


    public function userjobs()
    {
         return $this->belongsTo('App\Models\JobLeads', 'job_leads_id', 'job_leads_id');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function jobAmount()
    {
        return $this->belongsTo('App\Models\ContractualJobInform', 'job_id', 'job_id');
    }

    public function jobdetail()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'job_id');
    }

    public function jobcontractdetails()
    {
        return $this->hasOne('App\Models\JobContractDetails', 'job_leads_id', 'job_leads_id');
    }

    public function joborderinvoice()
    {
        return $this->hasOne('App\Models\JobOrderInvoice', 'contract_id', 'contract_id');
    }

    public function jobpaymentschedule()
    {
        return $this->hasMany('App\Models\JobPaymentSchedule', 'job_leads_id', 'job_leads_id');
    }

    public function advacne_amount() {
        return $this->jobpaymentschedule()->where('advance_payment','=', '1');
    }

}
