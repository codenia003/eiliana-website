<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use Sentinel;
use View;
use DB;
use App\Models\User;
use App\Models\ContractStaffingLeads;
use App\Models\JobLeads;
use App\Models\ProjectLeads;
use App\Models\ProjectScheduleModule;
use App\Notifications\UserNotification;

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
        $leads = ProjectLeads::with('projectdetail')->where('from_user_id', Sentinel::getUser()->id)->where('lead_status', '!=' ,'1')->paginate(10);
        // return $leads;
        return view('freelancer/myproject', compact('leads'));
    }

    public function projectSchedule($id)
    {
        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        // return $projectlead;
        return view('freelancer/project-schedule', compact('projectlead'));

    }

    public function projectScheduleUpdate(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';

        $projectschedulecheck = ProjectScheduleModule::where('project_schedule_module_id', '=', $input['module_id'])->where('module_status', '==', $input['modulestatus'])->first();
        if ($projectschedulecheck === null) {

            $projectschedule = ProjectScheduleModule::find($input['module_id']);
            $projectschedule->actual_module_start_date = $input['actual_module_start_date'];
            $projectschedule->module_status = $input['modulestatus'];
            $projectschedule->module_remark = $input['module_remark'];
            $projectschedule->save();

            $response['success'] = '1';
            $response['errors'] = 'Schedule Process successfully';

            $user = User::find($input['to_user_id']);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project SCEDULE',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/client/project-schedule/'. $input['lead_id'],
                'main_id' => $input['lead_id']
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already process this schedule';
        }
        return response()->json($response);
    }

}
