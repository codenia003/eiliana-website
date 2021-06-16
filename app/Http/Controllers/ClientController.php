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
use PDF;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Job;
use App\Models\ContractStaffingLeads;
use App\Models\ContractualJobInform;
use App\Models\ContractualJobSchedule;
use App\Models\SalesReferral;
use App\Models\ProjectLeads;
use App\Models\Project;
use App\Models\JobOrderInvoice;
use App\Models\JobLeads;
use App\Models\Finance;
use App\Models\Technology;
use App\Models\ResourceDetails;
use App\Models\JobOrderFinance;
use App\Models\JobContractDetails;
use App\Models\JobPaymentSchedule;
use App\Models\ProjectSchedule;
use App\Models\ProjectContractDetails;
use App\Models\ProjectBudgetAmount;
use App\Models\ProjectPaymentSchedule;
use App\Models\JobOnboarding;
use App\Notifications\UserNotification;
use Carbon\Carbon;

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

    public function myRequirementJob()
    {
        //$leads = ContractStaffingLeads::with('touser')->where('from_user_id', Sentinel::getUser()->id)->latest()->get();
        $leads = Job::with('locations','jobdetail','technologys')->where('user_id', Sentinel::getUser()->id)->paginate(10);
        //return $leads;
        return view('client/myrequirementjob', compact('leads'));
    }

    public function myRequirementProject()
    {
        $technologies = Technology::where('parent_id', '0')->get();
        $leads = Project::with('locations','projectdetail','technologys','projectamount')->where('posted_by_user_id', Sentinel::getUser()->id)->paginate(10);
        //return $leads;
        return view('client/myrequirementproject', compact('leads','technologies'));
    }

    public function myDeliveryJob()
    {
        $delivery_job = JobOrderFinance::with('userjobs','userjobs.jobcontractschedule','userjobs.jobdetail','userjobs.fromuser','userjobs.jobdetail.by_user_job')->where('status', '=', '2')->get();
        // return $delivery_job;
        return view('client/mydeliveryjob', compact('delivery_job'));
    }

    public function myDeliveryProject()
    {
        $delivery_project = Finance::with('userprojects','userprojects.projectdetail','userprojects.fromuser','userprojects.projectdetail.companydetails')->where('status', '=', '2')->get();
        //return $delivery_project;
        return view('client/mydeliveryproject', compact('delivery_project'));
    }

    public function myRequirementView($id) {

        $leads = ContractStaffingLeads::with('touser')->where('staffing_leads_id', $id)->first();

        return view('client/myrequirementview', compact('leads'));
    }

    public function myProposal()
    {
        $leads = ContractualJobSchedule::with('userjobs','jobdetail.by_user_job','userjobs.fromuser','jobAmount')->paginate(10);
        //return $leads;
        return view('client/myproposal', compact('leads'));
    }

    public function myProposalView($id)
    {
        $leads = JobLeads::with('fromuser')->where('job_id', $id)->first();
        return view('client/myproposalview', compact('leads'));
    }

    public function resourceDetailsForm($id)
    {
        $leads =ContractualJobSchedule::with('userjobs','jobdetail.by_user_job','userjobs.fromuser','jobAmount')->where('job_schedule_id', '=', $id)->first();
        //return $leads;
        return view('client/resource_details_form', compact('leads'));
    }

    public function postResourceDetails(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';
        
        $job_resource_details = new ResourceDetails;
        $job_resource_details->job_schedule_id = $input['job_schedule_id'];
        $job_resource_details->freelancer_name = $input['freelancer_name'];
        $job_resource_details->sprovider_name = $input['sprovider_name'];
        $job_resource_details->onboard_date = $input['onboard_date'];
        $job_resource_details->onboard_status = $input['onboard_status'];
        $job_resource_details->save();

        $success = 'success';
        $msg = 'Resource details submit successfully';

        return redirect('/client/resource-details-form/'.$input['job_schedule_id'])->with($success ,  $msg);
    }

    public function myContractJob()
    {
        $jobs = Job::with('jobbidresponse','technologys','locations')->where('user_id', Sentinel::getUser()->id)->paginate(10);
       //return $jobs;
        return view('client/mycontractjob', compact('jobs'));
    }

    public function myProject()
    {
        $project_ids = Project::with('projectbidresponse','projectamount')->where('posted_by_user_id', Sentinel::getUser()->id)->paginate(10);
       //return $project_ids;
        return view('client/myproject', compact('project_ids'));
    }

    public function myProjectLeadView($id)
    {
        $leads = ProjectLeads::with('projectdetail','fromuser')->where('project_id', $id)->where('lead_status', '!=' ,'1')->paginate(10);
        //return $leads;
        return view('client/myprojectlead', compact('leads'));
    }

    public function myJobLeadView($id)
    {
        $leads = JobLeads::with('jobdetail','fromuser')->where('job_id', $id)->where('lead_status', '!=' ,'1')->paginate(10);
        $resource_leads = ResourceDetails::all();
        //return $leads;
        return view('client/myjoblead', compact('leads','resource_leads'));
    }

    public function projectSchedule($id)
    {

        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        //return $projectlead;
        return view('client/project-schedule', compact('projectlead'));
    }

    public function projectLeadSchedule(Request $request) {

        $input = $request->except('_token');
        $user = Sentinel::getUser();
        $response['success'] = '0';

        $projectschedulecheck = ProjectSchedule::where('project_schedule_id', '=', $input['schedule_id'])->where('satuts', '!=', '1')->first();
        if ($projectschedulecheck === null) {

            $projectschedules = ProjectSchedule::find($input['schedule_id']);
            $projectschedules->satuts = $input['lead_status'];
            $projectschedules->save();

            $projectleads = ProjectLeads::where('project_leads_id', $projectschedules->project_leads_id)->first();
            $projects = Project::where('project_id', $projectleads->project_id)->first();
            $project_amounts = ProjectBudgetAmount::where('project_id', $projectleads->project_id)->first();

            if($input['lead_status'] === '2') {
                $projectleadsstatus = ProjectLeads::find($projectschedules->project_leads_id);
                $projectleadsstatus->status = '5';
                $projectleadsstatus->save();

                $input['user_id'] = $user->id;

                $contractdetails = new ProjectContractDetails;
                $contractdetails->project_leads_id = $projectschedules->project_leads_id;
                $contractdetails->from_user_id = $input['user_id'];
                $contractdetails->order_closed_value = $project_amounts->project_amount_to;
                $contractdetails->model_engagement = $input['pricing_model'];

                // $contractdetails->model_engagement = $input['model_engagement'];
                $contractdetails->ordering_com_name = 'Eiliana';
                // $contractdetails->sales_comm_amount = $input['sales_comm_amount'];
                // $contractdetails->remarks = $input['remarks'];
                // $contractdetails->advance_payment_details = $input['advance_payment_details'];
                $contractdetails->status = '1';
                $contractdetails->save();

                $insertedId = $contractdetails->contract_id;

                // Mail::send('emails.emailTemplates.invoice', $data, function ($m) use ($data) {
                //     $m->from('info@eiliana.com', 'Eiliana OTP');
                //     $m->to($data['email'], 'Eiliana')->subject('OTP for Eiliana');
                // });

                $paymentschedule = new ProjectPaymentSchedule;
                $paymentschedule->project_leads_id = $projectschedules->project_leads_id;
                $paymentschedule->contract_id = $insertedId;
                // $paymentschedule->advance_payment = $input['advance_payment'][$key];
                // $paymentschedule->installment_no = $input['payment_schedule_id'][$key];
                $paymentschedule->installment_amount = $project_amounts->project_amount_to;
                // $paymentschedule->paymwnt_due_date = $input['paymwnt_due_date'][$key];
                // $paymentschedule->milestones_name = $input['milestones_name'][$key];
                $paymentschedule->status = '1';
                $paymentschedule->save();

                

                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Accepted successfully';
                $user = User::find($projects->posted_by_user_id);

                if($input['pricing_model'] == '1')
                {
                    $url = '/client/project-contract-details/'. $projectschedules->project_leads_id;
                }
                elseif($input['pricing_model'] == '2')
                {
                    $url = '/client/project-retainer-contract-details/'. $projectschedules->project_leads_id;
                }

            } elseif($input['lead_status'] === '3') {
                $projectleadsstatus = ProjectLeads::find($projectschedules->project_leads_id);
                $projectleadsstatus->status = '4';
                $projectleadsstatus->save();

                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Modify Request to freelancer successfully';
                $url = '/project/project-schedule-modify/'. $projectschedules->project_leads_id;
                $user = User::find($projectleads->from_user_id);

            } else {
                $projectleadsstatus = ProjectLeads::find($projectschedules->project_leads_id);
                $projectleadsstatus->status = '3';
                $projectleadsstatus->save();

                $response['success'] = '2';
                $response['errors'] = 'Proposal Schedule Rejected successfully';
                $url = '#';
                $user = User::find($projectleads->from_user_id);
            }

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project schedule proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => $url,
                'main_id' => $projectschedules->project_leads_id
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal schedule';
        }
        return response()->json($response);

    }

    public function projectRetainerContractDetails($id)
    {
        $projectlead = ProjectLeads::with('fromuser','projectdetail','projectdetail.projectamount','projectdetail.projectCurrency','contractdetails','contractdetails.paymentschedule')->where('project_leads_id', $id)->first();
        //return $projectlead;
        return view('client/project-contract-details', compact('projectlead'));
    }

    public function projectContractDetails($id)
    {
        //$projectlead = ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();
        $projectlead = ProjectLeads::with('fromuser','projectdetail','projectdetail.projectamount','projectdetail.projectCurrency','contractdetails','contractdetails.paymentschedule')->where('project_leads_id', $id)->first();
        
        //return $projectlead;
        return view('client/contract-details', compact('projectlead'));
    }

    public function postProjectContractDetails(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $contractdetailscheck = ProjectContractDetails::where('contract_id', '=', $input['contract_id'])->where('status', '!=', '1')->first();
        if ($contractdetailscheck === null) {

            $projectcontractdetail = ProjectContractDetails::find($input['contract_id']);
            $projectcontractdetail->status = $input['lead_status'];
            $projectcontractdetail->save();

            if($input['lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Proposal Contract Accepted successfully';
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Contract Rejected successfully';
            }

            $projectleads = ProjectLeads::where('project_leads_id', $projectcontractdetail->project_leads_id)->first();

            $user = User::find($projectleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project schedule proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/project/project-finance/'. $projectcontractdetail->project_leads_id,
                'main_id' => $projectcontractdetail->project_leads_id
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal';
        }
        return response()->json($response);

    }

    public function postProjectContractPayment(Request $request)
    {
        $input = $request->except('_token');

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['payment_id']);

        if(count($input)  && !empty($input['payment_id'])) {
            try {
                $response = $api->payment->fetch($input['payment_id'])->capture(array('amount'=>$payment['amount']));

                $paymentschedule = ProjectPaymentSchedule::find($input['payment_schedule_id']);
                $paymentschedule->status = $input['status'];
                $paymentschedule->payment_id = $input['payment_id'];
                $paymentschedule->total_advance_payment = $input['total_advance_payment'];
                $paymentschedule->hours_purchase = $input['hours_purchase'];
                $paymentschedule->save();


                $projectleads = ProjectLeads::where('project_leads_id', $input['proposal_id'])->first();

                $user = User::find($projectleads->from_user_id);

                $advance_body = 'Payemnt process by Client';
                $advance_url =  '/project/project-finance/'. $input['proposal_id'];
                $msg = 'Payment Process successfully';

                // if($paymentschedule->advance_payment == '1'){
                //     $advance_body = 'Advacne Payemnt process by Client';
                //     $advance_url =  '/project/project-finance/'. $input['proposal_id'];
                //     $msg = 'Advance Payment Process successfully';
                // } else {
                //     $advance_body = 'Payemnt process by Client';
                //     $advance_url =  '/freelancer/my-project-schedule/'. $input['proposal_id'];
                //     $msg = 'Payment Process successfully';
                // }

                $details = [
                    'greeting' => 'Hi '. $user->full_name,
                    'body' => $advance_body,
                    'thanks' => 'Thank you for using eiliana.com!',
                    'actionText' => 'View My Site',
                    'actionURL' => $advance_url,
                    'main_id' => $input['proposal_id']
                ];

                Notification::send($user, new UserNotification($details));

                return redirect('/client/my-project')->with('success', 'Advance Payment Process successfully');

            } catch (\Exception $e) {
                return  $e->getMessage();
                return redirect()->back()->with('error', $e->getMessage());
                return redirect()->back();
            }
        }
    }

    public function postRetainerProjectContractPayment(Request $request)
    {
        $input = $request->except('_token');

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['payment_id']);

        if(count($input)  && !empty($input['payment_id'])) {
            try {
                $response = $api->payment->fetch($input['payment_id'])->capture(array('amount'=>$payment['amount']));

                $paymentschedule = ProjectPaymentSchedule::find($input['payment_schedule_id']);
                $paymentschedule->status = $input['status'];
                $paymentschedule->payment_id = $input['payment_id'];
                $paymentschedule->save();


                $projectleads = ProjectLeads::where('project_leads_id', $input['project_leads_id'])->first();

                $user = User::find($projectleads->from_user_id);

                $advance_body = 'Payemnt process by Client';
                $advance_url =  '/project/project-retainer-finance/'. $input['project_leads_id'];
                $msg = 'Payment Process successfully';

                // if($paymentschedule->advance_payment == '1'){
                //     $advance_body = 'Advacne Payemnt process by Client';
                //     $advance_url =  '/project/project-finance/'. $input['proposal_id'];
                //     $msg = 'Advance Payment Process successfully';
                // } else {
                //     $advance_body = 'Payemnt process by Client';
                //     $advance_url =  '/freelancer/my-project-schedule/'. $input['proposal_id'];
                //     $msg = 'Payment Process successfully';
                // }

                $details = [
                    'greeting' => 'Hi '. $user->full_name,
                    'body' => $advance_body,
                    'thanks' => 'Thank you for using eiliana.com!',
                    'actionText' => 'View My Site',
                    'actionURL' => $advance_url,
                    'main_id' => $input['project_leads_id']
                ];

                Notification::send($user, new UserNotification($details));

                return redirect('/client/my-project')->with('success', 'Advance Payment Process successfully');

            } catch (\Exception $e) {
                return  $e->getMessage();
                return redirect()->back()->with('error', $e->getMessage());
                return redirect()->back();
            }
        }
    }

    public function projectPayments($id)
    {
        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();

        //$next_installment = ProjectPaymentSchedule::where('project_leads_id',$id)->where('status', '!=','2')->first();

        //return $projectlead;
        return view('client/recommend', compact('projectlead'));
    }

    public function ContractualJobInform($id)
    {
        $contractual_job = ContractualJobSchedule::with('locations')->where('job_leads_id', $id)->first();
        // $joblead = JobLeads::where('job_leads_id', $id)->first();
        return view('client/contractual-job-inform', compact('contractual_job'));
    }

    public function ContractualJobLeadSchedule(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $contractualjobschedulecheck = ContractualJobSchedule::where('job_schedule_id', '=', $input['job_schedule_id'])->where('satuts', '!=', '1')->first();
        if ($contractualjobschedulecheck === null) {

            $contractualjob_schedules = ContractualJobSchedule::find($input['job_schedule_id']);
            $contractualjob_schedules->satuts = $input['lead_status'];
            $contractualjob_schedules->save();

            if($input['lead_status'] === '2'){
                // $JobLeads = JobLeads::find($contractualjob_schedules->job_leads_id);
                // $jobstatus->lead_status = '5';
                // $jobstatus->save();

                $joblead = JobLeads::where('job_leads_id', $contractualjob_schedules->job_leads_id)->first();

                if ($contractualjob_schedules->pricing_cycle == 1) {
                    $advance_payment_details = $contractualjob_schedules->price*1;
                } elseif($contractualjob_schedules->pricing_cycle == 2) {
                    $advance_payment_details = $contractualjob_schedules->price*3;
                } elseif($contractualjob_schedules->pricing_cycle == 3) {
                    $advance_payment_details = $contractualjob_schedules->price*2;
                } else {
                    $advance_payment_details = $contractualjob_schedules->price*12;
                }
                

                $contractdetails = new JobContractDetails;
                $contractdetails->job_leads_id = $contractualjob_schedules->job_leads_id;
                $contractdetails->from_user_id = $joblead->from_user_id;
                $contractdetails->order_closed_value = $contractualjob_schedules->price;
                $contractdetails->date_acceptance = Carbon::today()->toDateString();
                $contractdetails->ordering_com_name = $contractualjob_schedules->company_name;
                $contractdetails->remarks = $contractualjob_schedules->remarks;
                $contractdetails->advance_payment_details = $advance_payment_details;
                $contractdetails->status = '1';
                $contractdetails->save();

                $insertedId = $contractdetails->contract_id;
                
                $paymentschedule = new JobPaymentSchedule;
                $paymentschedule->job_leads_id = $contractualjob_schedules->job_leads_id;
                $paymentschedule->contract_id = $insertedId;
                $paymentschedule->installment_no = 1;
                $paymentschedule->installment_amount = $advance_payment_details;
                $paymentschedule->paymwnt_due_date = Carbon::today()->toDateString();
                $paymentschedule->milestones_name = 'NA';
                $paymentschedule->status = '1';
                $paymentschedule->save();

                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Accepted successfully';
                $url = '/job/job-contract-details/'. $contractualjob_schedules->job_leads_id;
                $url = '#';
            } elseif($input['lead_status'] === '3') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Modify Request to freelancer successfully';
                $url = '/job/job-schedule-modify/'. $contractualjob_schedules->job_leads_id;
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Schedule Rejected successfully';
                $url = '#';
            }
            // $url = '#';
            $response['job_leads_id'] = $contractualjob_schedules->job_leads_id;
            $contractualjob_leads = JobLeads::where('job_leads_id', $contractualjob_schedules->job_leads_id)->first();

            $user = User::find($contractualjob_leads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project schedule proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => $url,
                'main_id' => $contractualjob_schedules->job_leads_id
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '3';
            $response['errors'] = 'You are already accept this proposal schedule';
            $response['job_leads_id'] = $contractualjobschedulecheck->job_leads_id;
        }
        return response()->json($response);

    }

    public function jobContractDetails($id)
    {
        $joblead = JobLeads::with('jobdetail','jobcontractdetails','jobcontractdetails.joborderinvoice','jobcontractdetails.jobpaymentschedule','jobcontractdetails.jobadvacne_amount')->where('job_leads_id', $id)->first();
        // return $joblead;
        return view('client/job-contract-details', compact('joblead'));
    }

    public function postJobContractDetails(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $contractdetailscheck = JobContractDetails::where('contract_id', '=', $input['contract_id'])->where('status', '!=', '1')->first();
        if ($contractdetailscheck === null) {

            $jobcontractdetail = JobContractDetails::find($input['contract_id']);
            $jobcontractdetail->status = $input['lead_status'];
            $jobcontractdetail->save();

            if($input['lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Proposal Contract Accepted successfully';
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Contract Rejected successfully';
            }

            $jobleads = JobLeads::where('job_leads_id', $jobcontractdetail->job_leads_id)->first();

            $user = User::find($jobleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your job schedule proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/job/job-finance/'. $jobcontractdetail->job_leads_id,
                'main_id' => $jobcontractdetail->job_leads_id
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal';
        }
        return response()->json($response);

    }

    public function postContractualJobPayment(Request $request)
    {
        $input = $request->except('_token');

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['payment_id']);

        if(count($input)  && !empty($input['payment_id'])) {
            try {
                $response = $api->payment->fetch($input['payment_id'])->capture(array('amount'=>$payment['amount']));

                $paymentContractualJob = JobPaymentSchedule::find($input['payment_schedule_id']);
                $paymentContractualJob->status = '2';
                $paymentContractualJob->payment_id = $input['payment_id'];
                $paymentContractualJob->save();


                $joblead = JobLeads::where('job_leads_id', $input['job_leads_id'])->first();

                $user = User::find($joblead->from_user_id);
                $advance_body = 'Payemnt process by Client';
                $advance_url =  '/job/job-finance/'. $input['job_leads_id'];
                $msg = 'Payment Process successfully';


                $details = [
                    'greeting' => 'Hi '. $user->full_name,
                    'body' => $advance_body,
                    'thanks' => 'Thank you for using eiliana.com!',
                    'actionText' => 'View My Site',
                    'actionURL' => $advance_url,
                    'main_id' => $input['job_leads_id']
                ];

                Notification::send($user, new UserNotification($details));

                return redirect('/client/my-project')->with('success', 'Payment Process successfully');

            } catch (\Exception $e) {
                return  $e->getMessage();
                return redirect()->back()->with('error', $e->getMessage());
                return redirect()->back();
            }
        }
    }

    public function postProposalJobLead(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';
        $proposaljobleadcheck = ContractualJobSchedule::where('job_schedule_id', '=', $input['job_schedule_id'])->where('satuts', '=', '2')->first();
        if (!empty($proposaljobleadcheck)) {

            $job_proposal_leads = ContractualJobSchedule::where('job_schedule_id', '=', $input['job_schedule_id'])->where('satuts', '=', '2')->first();
            if(!empty($job_proposal_leads))
            {
                $job_proposal_leads->actual_start_date = $input['actual_date'];
                $job_proposal_leads->save();

                $success = 'success';
                $msg = 'Proposal date update successfully';
            }
            else {
                $success = 'error';
                $msg = 'You are already updated date this proposal';
            }
        } else {
            $success = 'error';
            $msg = 'First accept contractual job schedule';
        }

        return redirect('/client/my-proposal')->with($success ,  $msg);
    }

    public function GenerateInvoice(Request $request)
    {
        // $response['success'] = '0';
        // $campaigns = JobOrderInvoice::where('order_invoice_id', '=', $id)->first();
        // //return $campaigns;
        // if($campaigns != null)
        // {
        //     $pdf = PDF::loadView('pdf.invoice', compact('campaigns'));
        //     $pdf->download('receipt.pdf');
        //     $response['success'] = '1';
        //     $response['msg'] = 'Download invoice pdf successfully';
        // }
        // return response()->json($response);

        $campaigns = JobOrderInvoice::where('order_invoice_id', '=', '2')->first();
        view()->share('campaigns',$campaigns);

        if($request->has('download')){
            $pdf = PDF::loadView('pdf.invoice');
            return $pdf->download('receipt.pdf');
        }
        return view('pdf.invoice');
    }

    public function postJobStatus(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $jobstatuscheck = Job::where('job_id', '=', $input['job_id'])->where('status', '=', $input['job_status'])->first();
        if($jobstatuscheck === null) {

            if($input['job_status'] === '2'){
                $jobstatus = Job::find($input['job_id']);
                $jobstatus->status = $input['job_status'];
                $jobstatus->save();

                $response['success'] = '1';
                $response['msg'] = 'Job Status Closed successfully';
            }else if($input['job_status'] === '3'){
                $jobstatus = Job::find($input['job_id']);
                $jobstatus->status = $input['job_status'];
                $jobstatus->save();

                $response['success'] = '2';
                $response['msg'] = 'Job Status Repost successfully';
            }else {
                $response['success'] = '3';
                $response['errors'] = 'You are already changed status';
            }

        } else {
            $response['success'] = '3';
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

    public function postProjectStatus(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $projectstatuscheck = Project::where('project_id', '=', $input['project_id'])->where('status', '=', $input['project_status'])->first();
        if($projectstatuscheck === null) {
                $projectstatus = Project::find($input['project_id']);
                $projectstatus->status = $input['project_status'];
                $projectstatus->save();

            if($input['project_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Project Status Closed successfully';
            }else if($input['project_status'] === '3'){
                $response['success'] = '2';
                $response['msg'] = 'Project Status Repost successfully';
            }else {
                $response['success'] = '3';
                $response['errors'] = 'You are already changed status';
            }

        } else {
            $response['success'] = '3';
            $response['errors'] = 'You are already changed status';
        }
        return response()->json($response);

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
                
                $users = User::find($jobstatus->from_user_id);
                $details = [
                    'greeting' => 'Hi '. $users->full_name,
                    'body' => 'You have response on your contractual job proposal',
                    'thanks' => 'Thank you for using eiliana.com!',
                    'actionText' => 'View My Site',
                    'actionURL' => '/freelancer/contractual-job-inform/'. $input['job_leads_id'],
                    'main_id' => $input['job_leads_id']
                ];

                Notification::send($users, new UserNotification($details));

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

    public function projectReviseProposal($id)
    {
        //$project = Project::with('companydetails','locations','projectAmount','projectCurrency','projectsubcategory','customerindustry1')->where('project_id', $id)->first();
        $project = ProjectLeads::with('projectdetail','projectdetail.projectAmount','projectdetail.projectCurrency')->where('project_leads_id', $id)->first();
        $technologies = Technology::where('display_status', '1')->orderBy('technology_name')->get();

        //return $project;
        return view('client/project-revise-proposal', compact('project','technologies'));
    }

    public function postProjectReviseProposal(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $projectrevisecheck = ProjectLeads::where('project_leads_id', '=', $input['project_leads_id'])->where('status', '!=', '1')->first();
        if ($projectrevisecheck === null) {

            $projectreviseproposal = ProjectLeads::find($input['project_leads_id']);
            $projectreviseproposal->status = $input['status'];
            $projectreviseproposal->save();

            $user = User::find($projectreviseproposal->from_user_id);

            if($input['status'] === '2') {
                $response['success'] = '1';
                $response['msg'] = 'Revise Proposal Accepted successfully';
                $url = '/freelancer/my-project';
            }else {
                $response['success'] = '2';
                $response['errors'] = 'Revise Proposal Rejected successfully';
                $url = '/freelancer/my-project';
            }

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your revise proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => $url,
                'main_id' => $input['project_leads_id']
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this revise proposal';
        }
        return response()->json($response);

    }

    public function postJobOnboarding(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $jobonboardingcheck = JobOnboarding::where('job_order_id', '=', $input['job_order_id'])->first();
        if ($jobonboardingcheck === null) {

            $jobonboarding = new JobOnboarding;
            $jobonboarding->job_order_id = $input['job_order_id'];
            $jobonboarding->job_leads_id = $input['job_leads_id'];
            $jobonboarding->date_onboarding = $input['date_onboarding'];
            $jobonboarding->status = $input['status'];
            $jobonboarding->save();

            $job_finance = JobOrderFinance::find($input['job_order_id']);
            $job_finance->status = '3';
            $job_finance->save();


            $response['success'] = '1';
            $response['msg'] = 'Proposal Contract Accepted successfully';

            $joblead = JobLeads::where('job_leads_id', $input['job_leads_id'])->first();

            $user = User::find($joblead->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You on boarding schedule today',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '#',
                'main_id' => $jobonboarding->job_onboarding_id,
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this';
        }
        return response()->json($response);
    }
    
}
