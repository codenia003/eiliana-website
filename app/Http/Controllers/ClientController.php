<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use View;
use DB;
use App\Models\ContractStaffingLeads;

class ClientController extends JoshController
{
    public function myLead()
    {
        return view('client/mylead');
    }

    public function myRequirement()
    {
        $leads = ContractStaffingLeads::with('touser')->where('from_user_id', Sentinel::getUser()->id)->get();

        return view('client/myrequirement', compact('leads'));
    }

    public function myRequirementView($id) {

        $leads = ContractStaffingLeads::with('touser')->where('staffing_leads_id', $id)->first();

        return view('client/myrequirementview', compact('leads'));
    }

    public function myProposal()
    {
        return view('client/myproposal');
    }

    public function myProject()
    {
        return view('client/myproject');
    }
}
