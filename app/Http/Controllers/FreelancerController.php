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
use App\Models\Location;
use App\Models\Job;
use App\Models\SaveJob;
use App\Models\ContractStaffingLeads;
use App\Models\JobLeads;
use App\Models\ProjectLeads;
use App\Models\ContractualJobSchedule;
use App\Models\ProjectSchedule;
use App\Models\JobProposal;
use App\Models\JobOrderFinance;
use App\Models\Finance;
use App\Models\Country;
use App\Models\ProjectScheduleModule;
use App\Models\ProjectSubScheduleModule;
use App\Models\ProjectContractDetails;
use App\Models\ProjectPaymentSchedule;
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

    public function mySaveJob()
    {
        $savejobs = SaveJob::with('jobdetail')->where('user_id', Sentinel::getUser()->id)->paginate(10);
        //return $savejobs;
        return view('freelancer/mysavejob', compact('savejobs'));
    }

    public function myProject()
    {
        $leads = ProjectLeads::with('projectdetail','projectdetail.technologys','projectdetail.projectamount')->where('from_user_id', Sentinel::getUser()->id)->where('lead_status', '!=' ,'1')->paginate(10);
        //return $leads;
        return view('freelancer/myproject', compact('leads'));
    }

    public function myJobProposal()
    {
        $leads = JobLeads::with('jobdetail','jobdetail.technologys','jobcontractschedule')->where('from_user_id', Sentinel::getUser()->id)->paginate(10);
        //return $leads;
        return view('freelancer/myproposal', compact('leads'));
    }

    public function myDeliveryJob()
    {
        $delivery_job = JobOrderFinance::with('userjobs','userjobs.jobcontractschedule','userjobs.jobdetail','userjobs.fromuser','userjobs.jobdetail.by_user_job')->join('job_leads', 'job_leads.job_leads_id', '=', 'job_order_finance.job_leads_id')->where('job_leads.from_user_id', Sentinel::getUser()->id)->get();
        // return $delivery_job;
        return view('freelancer/mydeliveryjob', compact('delivery_job'));
    }

    public function myDeliveryProject()
    {
        $delivery_project = Finance::with('userprojects','userprojects.projectdetail','userprojects.projectdetail.projectamount','userprojects.fromuser','userprojects.projectdetail.companydetails')->join('project_leads', 'project_leads.project_leads_id', '=', 'project_order_finance.project_leads_id')->where('project_leads.from_user_id', Sentinel::getUser()->id)->get();
        // return $delivery_project;
        return view(' freelancer/mydeliveryproject', compact('delivery_project'));
    }

    public function myDeliveryProjectView($id)
    {
        $delivery_project = Finance::with('userprojects','userprojects.projectdetail','userprojects.projectdetail.projectamount','userprojects.fromuser','userprojects.projectdetail.companydetails')->where('order_finance_id', $id)->first();

        
        $finance =  ProjectLeads::with('projectdetail','projectdetail.projectCurrency','projectschedulee','projectschedulee.schedulemodulee','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $delivery_project->project_leads_id)->first();
        
        // if($finance->projectdetail->referral_id != '0') 
        // {
        //     $gst_rate = 18;
        //     $price = $finance->total_proposal_value;
        //     $GST_amount = ($price * $gst_rate) / 100;
        //     $total_price = $price + $GST_amount;

        //     $installment = $finance->contractdetails->order_closed_value;
        //     $commission = $finance->sales_comm_amount;
        //     $total_commission = $installment * $commission/100;
        // }
        // else
        // {
        //     $gst_rate = 18;
        //     $price = number_format($finance->contractdetails->order_closed_value, 0, ".", "");
        //     $GST_amount = ($price * $gst_rate) / 100;
        //     $total_price = $price + $GST_amount;

        //     $total_commission = 0;
        // }
        
        // return $delivery_project;
        return view(' freelancer/mydeliveryprojectview', compact('delivery_project','finance'));
    }

    public function projectSchedule($id)
    {
        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        // return $projectlead->projectschedulee->project_schedule_id;
        //return $projectlead;
        $update_status = ProjectScheduleModule::where('project_schedule_id',$projectlead->projectschedulee->project_schedule_id)->where('module_status', '!=','3')->first();
        
        if(!empty($update_status)) {
            $update_status = $update_status->project_schedule_module_id;
            //return $update_status;
        }

        return view('freelancer/project-schedule', compact('projectlead','update_status'));

    }

    public function nextProjectScheduleModule($id)
    {
        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        // return $projectlead->projectschedulee->project_schedule_id;
        //return $projectlead;
        $update_status = ProjectScheduleModule::where('project_schedule_id',$projectlead->projectschedulee->project_schedule_id)->where('module_status', '!=','3')->first();
        
        if(!empty($update_status)) {
            $update_status = $update_status->project_schedule_module_id;
            //return $update_status;
        }

        return view('freelancer/next_project_module', compact('projectlead','update_status'));
    }

    public function projectScheduleUpdate(Request $request)
    {

        $input = $request->except('_token');
        //return $input;die;
        $response['success'] = '0';

        $projectschedulecheck = ProjectScheduleModule::where('project_schedule_module_id', '=', $input['module_id'])->where('module_status', '==', $input['modulestatus'])->first();
        if ($projectschedulecheck === null) {

            $projectschedule = ProjectScheduleModule::find($input['module_id']);
            $projectschedule->actual_module_start_date = $input['actual_module_start_date'];
            $projectschedule->module_status = $input['modulestatus'];
            $projectschedule->module_remark = $input['module_remark'];
            $projectschedule->save();

            $project_contract_details = ProjectContractDetails::where('project_leads_id', '=', $input['lead_id'])->first();
            
            if($project_contract_details->model_engagement == '2')
            {
                $get_installment_no = ProjectPaymentSchedule::where('project_leads_id', '=', $input['lead_id'])->first();
            
                $project_payment_schedule = ProjectPaymentSchedule::find($get_installment_no->payment_schedule_id);
                $project_payment_schedule->installment_no = $get_installment_no->installment_no + 1;
                $project_payment_schedule->status = 1;
                $project_payment_schedule->save();
            }
            elseif($project_contract_details->model_engagement == '3')
            {
                $get_installment_no = ProjectPaymentSchedule::where('project_leads_id', '=', $input['lead_id'])->first();
            
                $project_payment_schedule = ProjectPaymentSchedule::find($get_installment_no->payment_schedule_id);
                $project_payment_schedule->installment_no = $get_installment_no->installment_no + 1;
                $project_payment_schedule->status = 1;
                $project_payment_schedule->save();
            }

            $response['success'] = '1';
            $response['msg'] = 'Schedule Status changed successfully';

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

        // $insertedId = $projectschedules->project_schedule_id;

        // foreach ($input['module_id'] as $key => $value) {

        //     if($input['module_id'] == '1'){
        //         $current_pending = '1';
        //     } else {
        //         $current_pending = '0';
        //     }

        //     $schedulemodule = new ProjectScheduleModule;
        //     $schedulemodule->project_schedule_id = $insertedId;
        //     $schedulemodule->module_scope = $input['module_scope'][$key];
        //     // $schedulemodule->module_start_date = $input['module_start_date'][$key];
        //     // $schedulemodule->module_end_date = $input['module_end_date'][$key];
        //     if($input['pricing_model'] == '3')
        //     {
        //         $schedulemodule->payable_amount = $input['payable_amount'][$key];
        //         $schedulemodule->milestone_no = $input['milestone_no'][$key];
        //     }
            
        //     // $schedulemodule->hours_proposed = $input['hours_proposed'][$key];
        //     // $schedulemodule->hours_approved = $input['hours_approved'][$key];
        //     // $schedulemodule->modify_hours = $input['modify_hours'][$key];
        //     //$schedulemodule->module_status = $input['module_status'][$key];
        //     $schedulemodule->module_remark = $input['remarks'][$key];
        //     $schedulemodule->current = $current_pending;
        //     $schedulemodule->save();

        //     $insertedScheduleId = $schedulemodule->project_schedule_module_id;

        //     foreach ($input['sub_module_id'] as $key1 => $value1) {

        //         if ($input['sub_module_id'][$key1] == $input['module_id'][$key]) {

        //             $subschedulemodule = new ProjectSubScheduleModule;
        //             $subschedulemodule->project_schedule_module_id = $insertedScheduleId;
        //             $subschedulemodule->module_scope = $input['sub_module_scope'][$key1];
        //             $subschedulemodule->module_description = $input['sub_module_description'][$key1];
        //             $subschedulemodule->module_status = $input['sub_module_status'][$key1];
        //             $subschedulemodule->save();
        //         }
        //     }
        // }


        // $projectschedule_module = ProjectScheduleModule::find($input['module_id']);
        // $projectschedule_module->milestone_no = $input['milestone_no'];
        // $projectschedule_module->save();

        return redirect('/freelancer/my-project')->with('success', 'Project Schedule Completed');
    }

    public function ContractualJobInform($id)
    {
        $joblead = JobLeads::with('jobdetail','jobdetail.by_user_job','jobProposal')->where('job_leads_id', $id)->first();
        $locations = Location::all();
        // return $joblead;
        return view('freelancer/contractual-job-inform', compact('joblead','locations'));
    }

    public function postContractualJobInform(Request $request)
    {
        $input = $request->except('_token');

        $contractualJobs = new ContractualJobSchedule;
        $contractualJobs->job_leads_id = $input['job_leads_id'];
        $contractualJobs->job_proposal_id = $input['job_proposal_id'];
        $contractualJobs->job_id = $input['job_id'];
        $contractualJobs->customer_name = $input['customer_name'];
        $contractualJobs->price = $input['price'];

        // $contractualJobs->gst_rate = $input['gst_rate'];
        // $contractualJobs->total_price = $input['total_price'];
        $contractualJobs->notice_period = $input['notice_period'];
        $contractualJobs->company_name = $input['company_name'];
        $contractualJobs->job_start_date = $input['job_start_date'];
        $contractualJobs->remarks = $input['remarks'];

        $contractualJobs->contract_duration = $input['contract_duration'];
        $contractualJobs->pricing_cycle = $input['pricing_cycle'];
        // if($contractualJobs->pricing_cycle == 2)
        // {
        //     $contractualJobs->advance_amount = $input['advance_amount'];
        //     $contractualJobs->on_postpaid_amount = $input['on_postpaid_amount'];
        // }


        $contractualJobs->location = $input['location'];
        $contractualJobs->save();

        $jobleadchange = JobLeads::find($contractualJobs->job_leads_id);
        $jobleadchange->price_per_month = $input['price'];
        $jobleadchange->save();

        $insertedId = $contractualJobs->job_schedule_id;
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

    public function postProposalJobLead(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';
        $proposaljobleadcheck = ContractualJobSchedule::where('job_schedule_id', '=', $input['job_schedule_id'])->where('satuts', '=', '2')->first();
        if (!empty($proposaljobleadcheck)) {

            $job_proposal_leads = ContractualJobSchedule::where('job_schedule_id', '=', $input['job_schedule_id'])->where('satuts', '=', '2')->first();
            if(!empty($job_proposal_leads))
            {
                $job_proposal_leads->actual_start_date = $input['actual_date'];
                $job_proposal_leads->remarks = $input['remarks'];
                $job_proposal_leads->save();

                $insertedId = $job_proposal_leads->job_schedule_id;
                $job = Job::where('job_id', $job_proposal_leads->job_id)->first();

                $success = 'success';
                $msg = 'Proposal date update successfully';

                    if($insertedId != 0) {
                        $users = User::find($job->user_id);
                        $details = [
                            'greeting' => 'Hi '. $users->full_name,
                            'body' => 'You have response on your contractual job proposal',
                            'thanks' => 'Thank you for using eiliana.com!',
                            'actionText' => 'View My Site',
                            'actionURL' => '/client/resource-details-form/'. $insertedId,
                            'main_id' => $insertedId
                        ];
            
                        Notification::send($users, new UserNotification($details));
                    }
            }       
            else {
                $success = 'error';
                $msg = 'You are already updated date this proposal';
            }
        } else {
            $success = 'error';
            $msg = 'First accept contractual job schedule';
        }

        return redirect('/freelancer/my-contract_job')->with($success ,  $msg);
    }

    public function proposalJobStatus(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $jobstatuscheck = JobLeads::where('job_leads_id', '=', $input['job_leads_id'])->where('status', '=', $input['job_lead_status'])->first();
        if($jobstatuscheck === null) {
                $jobstatus = JobLeads::find($input['job_leads_id']);
                $jobstatus->status = $input['job_lead_status'];
                $jobstatus->save();

            if($input['job_lead_status'] === '1'){
                $response['success'] = '1';
                $response['msg'] = 'Job Status Resume Onhold successfully';
            }else if($input['job_lead_status'] === '2'){
                $response['success'] = '2';
                $response['msg'] = 'Job Status Resume Shortlist successfully';
            }else if($input['job_lead_status'] === '3'){
                $response['success'] = '3';
                $response['msg'] = 'Job Status Resume Reject successfully';
            }else if($input['job_lead_status'] === '4'){
                $response['success'] = '4';
                $response['msg'] = 'Job Status Review Proposal successfully';
            }else {
                $response['success'] = '5';
                $response['msg'] = 'Job Status Accept Proposal successfully';
            }

        } else {
            $response['success'] = '6';
            $response['errors'] = 'You are already changed status';
        }
        return response()->json($response);

    }

    public function proposalProjectStatus(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $projectstatuscheck = ProjectLeads::where('project_leads_id', '=', $input['project_leads_id'])->where('status', '=', $input['project_lead_status'])->first();
        if($projectstatuscheck === null) {
                $projectstatus = ProjectLeads::find($input['project_leads_id']);
                $projectstatus->status = $input['project_lead_status'];
                $projectstatus->save();

            if($input['project_lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Project Status Shortlist successfully';
            }else if($input['project_lead_status'] === '3'){
                $response['success'] = '2';
                $response['msg'] = 'Project Status Reject successfully';
            }else {
                $response['success'] = '3';
                $response['msg'] = 'Project Status Onhold successfully';
            }

        } else {
            $response['success'] = '4';
            $response['errors'] = 'You are already changed status';
        }
        return response()->json($response);

    }

}
