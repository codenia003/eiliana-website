<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use View;
use DB;
use App\Repositories\FinanceRepository;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Lang;
use App\Models\Finance;
use App\Models\JobOrderFinance;
use App\Models\Job;
use App\Models\JobLeads;
use App\Models\User;
use App\Models\ProjectLeads;
use App\Notifications\UserNotification;


class FinanceController extends Controller
{

    /** @var  FinanceRepository */
    private $financeRepository;

    public function __construct(FinanceRepository $financeRepo)
    {
        $this->financeRepository = $financeRepo;
    }

    public function index(Request $request)
    {
        $finances = Finance::with('userprojects','userprojects.projectdetail','userprojects.fromuser','userprojects.projectdetail.companydetails')->get();
        // return $finances;
        return view('admin.finance.index', compact('finances'));
    }

    public function jobFinance(Request $request)
    {
        $finances = JobOrderFinance::with('userjobs','userjobs.jobdetail','userjobs.fromuser','userjobs.jobdetail.by_user_job')->get();
        //return $finances;
        return view('admin.job_finance.index', compact('finances'));
    }

    public function edit($id)
    {
        $finance =  ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();
        $order_finances_id = Finance::where('project_leads_id', $id)->first();
        //return $finance;
        return view('admin.finance.edit', compact('finance'), compact('order_finances_id'));
    }

    public function assignToResource(Request $request)
    {

        $input = $request->except('_token');
        $response['success'] = '0';

        $financestatuscheck = Finance::where('order_finance_id', '=', $input['order_finance_id'])->where('status', '!=', '1')->first();
        if ($financestatuscheck === null) {

            $financeschedules = Finance::find($input['order_finance_id']);
            $financeschedules->status = $input['finance_status'];
            $financeschedules->save();

            if($input['finance_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Assign Finance Resource successfully';
            }

            $finance = ProjectLeads::with('projectdetail')->where('project_leads_id', $financeschedules->project_leads_id)->first();

            $user = User::find($finance->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your assign finance resource',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/freelancer/my-project',
                'main_id' => $financeschedules->project_leads_id
            ];

            Notification::send($user, new UserNotification($details));

            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("Ankur.Gupta@futuremakers.in:Eiliana@2020")
            );

            $postRequest = array(
                'name' =>  $finance->projectdetail->project_title .'_'.$financeschedules->project_leads_id,
                'start_date' => 'NA',
                'deadline' => 'NA',
                'notes' => 'NA'
            );

            $url = 'https://www.webwork-tracker.com/rest-api/projects';

            $postData = '';
            foreach($postRequest as $k => $v)
            {
                $postData .= $k . '='.$v.'&';
            }
            $postData = rtrim($postData, '&');

            // $payload = json_encode($postRequest);
            // print_r($payload);
            $ch = curl_init();

            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $output=curl_exec($ch);

            if($output === false)
            {
                echo "Error Number:".curl_errno($ch)."<br>";
                echo "Error String:".curl_error($ch);
            }

            curl_close($ch);

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already assign finance resource';
        }
        return response()->json($response);
    }

    public function jobFinanceEdit($id)
    {

        $order_finances_id = JobOrderFinance::where('job_order_id', $id)->first();
        $finance =  JobLeads::with('jobdetail','jobcontractdetails','jobcontractdetails.joborderinvoice','jobcontractdetails.jobpaymentschedule')->where('job_leads_id', $order_finances_id->job_leads_id)->first();
        //return $finance;
        return view('admin.job_finance.edit', compact('finance'), compact('order_finances_id'));
    }

    public function JobAssignToResource(Request $request)
    {

        $input = $request->except('_token');
        $response['success'] = '0';

        $job_financestatuscheck = JobOrderFinance::where('job_order_id', '=', $input['job_order_id'])->where('status', '!=', '1')->first();
        if ($job_financestatuscheck === null) {

            $job_finance = JobOrderFinance::find($input['job_order_id']);
            $job_finance->status = $input['finance_status'];
            $job_finance->save();

            if($input['finance_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Job Assign Finance Resource successfully';
            }

            // $finance = JobLeads::where('job_leads_id', $job_finance->job_leads_id)->first();

            // $user = User::find($finance->from_user_id);

            // $details = [
            //     'greeting' => 'Hi '. $user->full_name,
            //     'body' => 'You have response on your job assign finance resource',
            //     'thanks' => 'Thank you for using eiliana.com!',
            //     'actionText' => 'View My Site',
            //     'actionURL' => '/freelancer/my-proposal',
            //     'main_id' => $job_finance->job_leads_id
            // ];

            // Notification::send($user, new UserNotification($details));

            $jobleads = JobLeads::where('job_leads_id', $job_finance->job_leads_id)->first();
            $job = Job::where('job_id', $jobleads->job_id)->first();

            $users = User::find($job->user_id);
            $details = [
                'greeting' => 'Hi '. $users->full_name,
                'body' => 'You have response on your contractual job proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/client/my-proposal',
                'main_id' => $job_finance->job_leads_id
            ];

            Notification::send($users, new UserNotification($details));


        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already assign finance resource';
        }
        return response()->json($response);
    }

}
