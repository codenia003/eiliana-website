<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectContractDetails extends Model
{
    protected $table = 'project_contract_details';

    protected $primaryKey = 'contract_id';

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
}
