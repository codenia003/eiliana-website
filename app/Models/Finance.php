<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    public $table = 'project_order_finance';

    protected $primaryKey = 'order_finance_id';


    public function orderinvoice()
    {
        return $this->hasOne('App\Models\ProjectOrderInvoice', 'contract_id', 'contract_id');
    }

    public function paymentschedule()
    {
        return $this->hasMany('App\Models\ProjectPaymentSchedule', 'contract_id', 'contract_id');
    }

    public function advacne_amount() {
        return $this->paymentschedule()->where('advance_payment','=', '1');
    }

    public function projectschedulee()
    {
        return $this->hasMany('App\Models\ProjectSchedule', 'project_leads_id', 'project_leads_id');
    }

    public function contractdetails()
    {
        return $this->hasOne('App\Models\ProjectContractDetails', 'project_leads_id', 'project_leads_id');
    }

    public function userprojects()
    {
         return $this->belongsTo('App\Models\ProjectLeads', 'project_leads_id', 'project_leads_id');
    }


}
