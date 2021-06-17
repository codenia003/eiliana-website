<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Lang;
use Sentinel;
use View;
use Mail;
use Session;
use App\Models\User;
use App\Models\SalesReferral;
use App\Models\FreelanceReferral;
use App\Notifications\UserNotification;

class SalesController extends Controller
{
    public function index()
    {
        $sales_referrals = SalesReferral::with('companydetails')->get();
        //return $sales_referrals;
        return view('admin.salesReferral.index', compact('sales_referrals'));
    }

    public function edit($id)
    {
        $sales_referral =  SalesReferral::where('sales_referral_id', $id)->first();
        //return $finance;
        return view('admin.salesReferral.edit', compact('sales_referral'));
    }

    public function salesReferralAssignToClient(Request $request)
    {

        $input = $request->except('_token');
        $response['success'] = '0';

        $sales_referralstatuscheck = SalesReferral::where('sales_referral_id', '=', $input['sales_referral_id'])->where('lead_status', '!=', '1')->first();
        if ($sales_referralstatuscheck === null) {

            $sales_referral = SalesReferral::find($input['sales_referral_id']);
            $sales_referral->lead_status = $input['lead_status'];
            $sales_referral->save();

            if($input['lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Sales Referral Assign successfully';
                $actUrl = '/client/my-lead/'. $input['sales_referral_id'];
            }
            elseif($input['lead_status'] === '5')
            {
                $response['success'] = '1';
                $response['msg'] = 'Sales Referral Modify successfully';
                $actUrl = 'sales-referral-modify-form/'. $input['sales_referral_id'];
            }
            else
            {
                $response['success'] = '2';
                $response['errors'] = 'Sales Referral Rejected successfully';
                $actUrl = '/client/my-lead';
            }

            $user = User::find($sales_referral->user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your sales referral assign to client',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => $actUrl,
                'main_id' => $input['sales_referral_id']
            ];

            Notification::send($user, new UserNotification($details));
            
        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already assign sales referral';
        }
        return response()->json($response);
    }
}
