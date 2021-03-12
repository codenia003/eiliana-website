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
        //return $finances;
        return view('admin.finance.index', compact('finances'));
    }

    public function edit($id)
    {      
        $finance =  ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();
        $order_finances_id = Finance::where('project_leads_id', $id)->first();
        // return $finances;
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

            $finance = ProjectLeads::where('project_leads_id', $financeschedules->project_leads_id)->first();

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

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already assign finance resource';
        }
        return response()->json($response);
    }

}
