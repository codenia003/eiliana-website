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
use App\Models\JobOrderFinance;
use App\Models\JobContractDetails;
use App\Models\JobPaymentSchedule;
use App\Models\ProjectSchedule;
use App\Models\ProjectContractDetails;
use App\Models\ProjectPaymentSchedule;
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

    public function myRequirementJob()
    {
        //$leads = ContractStaffingLeads::with('touser')->where('from_user_id', Sentinel::getUser()->id)->latest()->get();
        $leads = Job::with('locations')->where('user_id', Sentinel::getUser()->id)->paginate(10);
        return view('client/myrequirementjob', compact('leads'));
    }

    public function myRequirementProject()
    {
        $leads = Project::with('locations')->where('posted_by_user_id', Sentinel::getUser()->id)->paginate(10);
        return view('client/myrequirementproject', compact('leads'));
    }

    public function myDeliveryJob()
    {
        $delivery_job = JobOrderFinance::with('userjobs','userjobs.jobdetail','userjobs.fromuser','userjobs.jobdetail.by_user_job')->where('status', '=', '2')->get();
        return $delivery_job;
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

    public function myContractJob()
    {
        $jobs = Job::with('jobbidresponse')->where('user_id', Sentinel::getUser()->id)->paginate(10);
       //return $jobs;
        return view('client/mycontractjob', compact('jobs'));
    }

    public function myProject()
    {
        $project_ids = Project::with('projectbidresponse')->where('posted_by_user_id', Sentinel::getUser()->id)->paginate(10);
       //return $project_ids;
        return view('client/myproject', compact('project_ids'));
    }

    public function myProjectLeadView($id)
    {
        $leads = ProjectLeads::with('projectdetail')->where('project_id', $id)->where('lead_status', '!=' ,'1')->paginate(10);
        // return $leads;
        return view('client/myprojectlead', compact('leads'));
    }

    public function projectSchedule($id)
    {

        $projectlead = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        //return $projectlead;
        return view('client/project-schedule', compact('projectlead'));
    }

    public function projectLeadSchedule(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        // $projectschedulecheck = ProjectSchedule::where('project_schedule_id', '=', $input['schedule_id'])->where('satuts', '!=', '1')->first();
        // if ($projectschedulecheck === null) {

            $projectschedules = ProjectSchedule::find($input['schedule_id']);
            $projectschedules->satuts = $input['lead_status'];
            $projectschedules->save();

            $projectleads = ProjectLeads::where('project_leads_id', $projectschedules->project_leads_id)->first();

            $user = User::find($projectleads->from_user_id);

            if($input['lead_status'] === '2') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Accepted successfully';
                $url = '/project/contract-details/'. $projectschedules->project_leads_id;
            } elseif($input['lead_status'] === '3') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Modify Request to freelancer successfully';
                $url = '/project/project-schedule-modify/'. $projectschedules->project_leads_id;
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Schedule Rejected successfully';
                $url = '#';
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

        // } else {
        //     $response['success'] = '2';
        //     $response['errors'] = 'You are already accept this proposal schedule';
        // }
        return response()->json($response);

    }

    public function projectContractDetails($id)
    {
        $projectlead = ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();

        // return $projectlead;
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
                $paymentschedule->save();


                $projectleads = ProjectLeads::where('project_leads_id', $input['proposal_id'])->first();

                $user = User::find($projectleads->from_user_id);


                if($paymentschedule->advance_payment == '1'){
                    $advance_body = 'Advacne Payemnt process by Client';
                    $advance_url =  '/project/project-finance/'. $input['proposal_id'];
                    $msg = 'Advance Payment Process successfully';
                } else {
                    $advance_body = 'Payemnt process by Client';
                    $advance_url =  '/freelancer/my-project-schedule/'. $input['proposal_id'];
                    $msg = 'Payment Process successfully';
                }

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
        //$joblead = JobLeads::where('job_leads_id', $id)->first();
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
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Accepted successfully';
                $url = '/job/job-contract-details/'. $contractualjob_schedules->job_leads_id;
            } elseif($input['lead_status'] === '3') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Schedule Modify Request to freelancer successfully';
                $url = '/job/job-schedule-modify/'. $contractualjob_schedules->job_leads_id;
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Schedule Rejected successfully';
                $url = '#';
            }

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
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal schedule';
        }
        return response()->json($response);

    }

    public function jobContractDetails($id)
    {
        $joblead = JobLeads::with('jobdetail','jobcontractdetails','jobcontractdetails.joborderinvoice','jobcontractdetails.jobpaymentschedule','jobcontractdetails.jobadvacne_amount')->where('job_leads_id', $id)->first();
        //return $joblead;
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

            $jobstatus = Job::find($input['job_id']);
            $jobstatus->status = $input['job_status'];
            $jobstatus->save();

            if($input['job_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Job Status Closed successfully';
            }if($input['job_status'] === '3'){
                $response['success'] = '2';
                $response['msg'] = 'Job Status Repost successfully';
            }else if($input['job_status'] === '1'){
                $response['success'] = '3';
                $response['msg'] = 'Job Status Online successfully';
            }

        } else {
            $response['success'] = '4';
            $response['errors'] = 'You are already changed status';
        }
        return response()->json($response);

    }
}
