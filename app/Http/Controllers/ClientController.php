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
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Job;
use App\Models\ContractStaffingLeads;
use App\Models\ContractualJobInform;
use App\Models\SalesReferral;
use App\Models\ProjectLeads;
use App\Models\JobLeads;
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
        //return $projectlead;
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
        $projectlead = ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();

        $next_installment = ProjectPaymentSchedule::where('project_leads_id',$id)->where('status', '!=','2')->first();

        // return $projectlead;
        return view('client/recommend', compact('projectlead', 'next_installment'));
    }

    public function ContractualJobInform($id)
    {
        $contractual_job = ContractualJobInform::orderBy('contractual_job_id', 'desc')->first();
        $joblead_id = JobLeads::where('job_leads_id', $id)->first();
        //$user = User::where('id', $joblead_id->from_user_id)->first();
        return view('client/contractual-job-inform', compact('joblead_id','contractual_job'));
    }

    public function postContractualJobPayment(Request $request)
    {
        $input = $request->except('_token');

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['payment_id']);

        if(count($input)  && !empty($input['payment_id'])) {
            try {
                $response = $api->payment->fetch($input['payment_id'])->capture(array('amount'=>$payment['amount']));

                $paymentContractualJob = ContractualJobInform::find($input['contractual_job_id']);
                $paymentContractualJob->status = '2';
                $paymentContractualJob->payment_id = $input['payment_id'];
                $paymentContractualJob->save();


                $joblead = JobLeads::where('job_leads_id', $input['referral_id'])->first();

                $user = User::find($joblead->from_user_id);
                $advance_body = 'Payemnt process by Client';
                $advance_url =  '/job/job-finance/'. $input['job_id'];
                $msg = 'Payment Process successfully';
            

                $details = [
                    'greeting' => 'Hi '. $user->full_name,
                    'body' => $advance_body,
                    'thanks' => 'Thank you for using eiliana.com!',
                    'actionText' => 'View My Site',
                    'actionURL' => $advance_url,
                    'main_id' => $input['job_id']
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
}
