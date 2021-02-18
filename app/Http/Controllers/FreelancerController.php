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
use App\Models\JobLeads;
use App\Models\ProjectLeads;

class FreelancerController extends Controller
{
    public function myLead()
    {
        return view('freelancer/mylead');
    }

    public function myOpportunity()
    {
        $leads = ContractStaffingLeads::with('fromuser')->where('to_user_id', Sentinel::getUser()->id)->paginate(10);
        return view('freelancer/myopportunity', compact('leads'));
    }

    public function myOpportunityView($id)
    {
        $leads = ContractStaffingLeads::with('fromuser')->where('staffing_leads_id', $id)->first();
        return view('freelancer/myopportunityview', compact('leads'));
    }

    public function myProposal()
    {
        $leads = JobLeads::with('jobdetail')->where('from_user_id', Sentinel::getUser()->id)->paginate(10);
        return view('freelancer/myproposal', compact('leads'));
    }

    public function myProposalView($id)
    {
        $leads = JobLeads::with('fromuser')->where('job_leads_id', $id)->first();
        return view('freelancer/myproposalview', compact('leads'));
    }

    public function myProject()
    {
        $leads = ProjectLeads::with('projectdetail')->where('from_user_id', Sentinel::getUser()->id)->paginate(10);
        // return $leads;
        return view('freelancer/myproject', compact('leads'));
    }
}
