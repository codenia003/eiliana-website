<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractProposalLeads extends Model
{
    protected $table = 'contract_proposal_leads';

    protected $primaryKey = 'proposal_leads_id';

    public function fromuser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function touser()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id', 'id');
    }
}
