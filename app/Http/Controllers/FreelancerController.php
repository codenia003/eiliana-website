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
use App\Models\Job;
use App\Models\ContractStaffingLeads;
use App\Models\JobLeads;
use App\Models\ProjectLeads;
use App\Models\ContractualJobInform;
use App\Models\ProjectSchedule;
use App\Models\JobProposal;
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
        // return $projectlead->projectschedulee->project_schedule_id;

        $update_status = ProjectScheduleModule::where('project_schedule_id',$projectlead->projectschedulee->project_schedule_id)->where('module_status', '!=','3')->first();
        if(!empty($update_status)) {
            $update_status = $update_status->project_schedule_module_id;
        }

        return view('freelancer/project-schedule', compact('projectlead','update_status'));

    }

    public function projectScheduleUpdate(Request $request)
    {

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
            $response['errors'] = 'Schedule Status changed successfully';

            $user = User::find($input['to_user_id']);

            if($input['modulestatus'] == '3') {
                $messsage = 'You have status on your project moduel completed';
            } else {
                $messsage = 'You have status on your project schedule';
            }

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => $messsage,
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/client/project-payment/'. $input['lead_id'],
                'main_id' => $input['lead_id']
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already process this schedule';
        }
        return response()->json($response);
    }

    public function postProjectSchedule(Request $request)
    {
        $input = $request->except('_token');

        $projectschedules = ProjectSchedule::find($input['project_schedule_id']);
        $projectschedules->satuts = '2';
        $projectschedules->save();

        return redirect('/freelancer/my-project')->with('success', 'Project Schedule Completed');
    }

    public function ContractualJobInform($id)
    {
        $joblead = JobLeads::where('job_leads_id', $id)->first();
        $job_proposal_id = JobProposal::where('job_leads_id', $id)->first();
        $user = User::where('id', $joblead->from_user_id)->first();
        return view('freelancer/contractual-job-inform', compact('joblead','user','job_proposal_id'));
    }

    public function postContractualJobInform(Request $request)
    {
        $input = $request->except('_token');

        $contractualJobs = new ContractualJobInform;
        $contractualJobs->candidate_name = $input['candidate_name'];
        $contractualJobs->job_leads_id = $input['job_leads_id'];
        $contractualJobs->job_proposal_id = $input['job_proposal_id'];
        $contractualJobs->job_id = $input['job_id'];
        $contractualJobs->customer_name = $input['customer_name'];
        $contractualJobs->billing_address = $input['billing_address'];
        $contractualJobs->price = $input['price'];
        $contractualJobs->gst_details = $input['gst_details'];
        $contractualJobs->date_acceptance = $input['date_acceptance'];
        $contractualJobs->end_date = $input['end_date'];
        $contractualJobs->contract_duration = $input['contract_duration'];
        $contractualJobs->pricing_cycle = $input['pricing_cycle'];
        $contractualJobs->client_period = $input['client_period'];
        $contractualJobs->location = $input['location'];
        $contractualJobs->remark = $input['remarks'];
        $contractualJobs->save();

        $insertedId = $contractualJobs->contractual_job_id;
        $job = Job::where('job_id', $input['job_id'])->first();

        if($insertedId != 0) {
            $users = User::find($job->user_id);
            $details = [
                'greeting' => 'Hi '. $users->full_name,
                'body' => 'You have response on your contractual job proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/client/contractual-job-inform/'. $input['job_leads_id'],
                'main_id' => $input['job_leads_id']
            ];

            Notification::send($users, new UserNotification($details));
         }

        return redirect('/freelancer/contractual-job-inform/'. $input['job_leads_id'])->with('success', 'Contractual Job Proposal Completed');
    }
}
