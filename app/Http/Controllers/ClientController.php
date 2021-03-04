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
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\ContractStaffingLeads;
use App\Models\SalesReferral;
use App\Models\ProjectLeads;
use App\Models\ProjectSchedule;
use App\Notifications\UserNotification;

class ClientController extends JoshController
{
    public function myLead()
    {
        $leads = SalesReferral::where('user_id', Sentinel::getUser()->id)->latest()->get();
        return view('client/mylead', compact('leads'));
    }

    public function myLeadView($id) {

        $leads = SalesReferral::where('sales_referral_id', $id)->first();

        return view('client/myleadview', compact('leads'));
    }

    public function myRequirement()
    {
        $leads = ContractStaffingLeads::with('touser')->where('from_user_id', Sentinel::getUser()->id)->latest()->get();

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

    public function projectSchedule($id)
    {

        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        // return $projectlead;
        return view('client/project-schedule', compact('projectlead'));
    }

    public function projectLeadSchedule(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $projectschedulecheck = ProjectSchedule::where('project_schedule_id', '=', $input['schedule_id'])->where('satuts', '!=', '1')->first();
        if ($projectschedulecheck === null) {

            $projectschedules = ProjectSchedule::find($input['schedule_id']);
            $projectschedules->satuts = $input['lead_status'];
            $projectschedules->save();

            if($input['lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Accepted successfully';
            } elseif($input['lead_status'] === '3') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Modify Request to freelancer successfully';
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Schedule Rejected successfully';
            }

            $projectleads = ProjectLeads::where('project_leads_id', $projectschedules->project_leads_id)->first();

            $user = User::find($projectleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project schedule proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/project/contract-details/'. $projectschedules->project_leads_id,
                'main_id' => $projectschedules->project_leads_id
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal schedule';
        }
        return response()->json($response);

    }

    public function contractDetails()
    {
        return view('client/contract-details');
    }
}
