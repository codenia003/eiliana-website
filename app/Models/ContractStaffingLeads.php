<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractStaffingLeads extends Model
{
    protected $table = 'contract_staffing_leads';

    protected $primaryKey = 'staffing_leads_id';

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function touser()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id', 'id');
    }
}
