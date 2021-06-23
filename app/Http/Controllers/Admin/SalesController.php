<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\JoshController;
//use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Lang;
use Sentinel;
use View;
use Mail;
use Session;
use App\Models\User;
use App\Models\Country;
use App\Models\SalesReferral;
use App\Models\TeamUser;
use App\Models\FreelanceReferral;
use App\Models\CustomerIndustry;
use App\Notifications\UserNotification;
use DB;

class SalesController extends JoshController
{
    private $user_activation = true;

    public function index()
    {
        $sales_referrals = SalesReferral::with('companydetails')->get();
        //return $sales_referrals;
        return view('admin.salesReferral.index', compact('sales_referrals'));
    }

    public function edit($id)
    {
        $company_types = DB::table('roles')->where('id', '!=', '1')->where('id', '!=', '2')->where('id', '!=', '3')->where('id', '!=', '7')->get();
        $sales_referral =  SalesReferral::where('sales_referral_id', $id)->first();
        $customer_industries = CustomerIndustry::all();
        $countries = Country::where('id', $sales_referral->country)->get();
        //return $company_types;
        return view('admin.salesReferral.edit', compact('sales_referral','company_types','customer_industries','countries'));
    }

    public function salesReferralAssignToClient(Request $request)
    {
        $activate = $this->user_activation;
        $input = $request->except('_token');
        $response['success'] = '0';

        $sales_referralstatuscheck = SalesReferral::where('sales_referral_id', '=', $input['sales_referral_id'])->where('lead_status', '!=', '1')->first();
        if ($sales_referralstatuscheck === null) {

            if($input['lead_status'] === '2'){

                $customer_emailcheck = User::where('email', '=', $input['email'])->first();
                if($customer_emailcheck === null)
                {
                    $customer_referral_idcheck = User::where('referral_id', '=', $input['sales_referral_id'])->first();
                    if($customer_referral_idcheck === null)
                    {
                        $applyas = '2';
                        $otp = rand(1000,9999);
                        $mobile_otp = rand(1000,9999);
                        $id = DB::table('user_registration')->insertGetId(
                            ['email' => $input['email'], 'mobile' => $input['mobile_no'], 'otp' => $otp, 'mobile_otp' => $mobile_otp]
                        );
    
                        $user = Sentinel::register(
                            ([
                            'title' => 'Mr',
                            'first_name' =>$input['contact_person'],
                            'username' => $input['contact_person'],
                            'company_name' => $input['company_name'],
                            'register_as' => '2',
                            'email' => $input['email'],
                            'password' => '12345678',
                            'mobile' => $input['mobile_no'],
                            'dob' => $input['dob'],
                            'city' => $input['city'],
                            'country' => $input['country'],
                            'registration_id' => $id,
                            'referral_id' => $input['sales_referral_id'],
                            'first_time' => '1',
                            ]), $activate
                        );
    
                        // login user automatically
                        $role = Sentinel::findRoleById($applyas);
                        //add user to 'User' role
                        $role->users()->attach($user);
    
                        activity($user->full_name)
                            ->performedOn($user)
                            ->causedBy($user)
                            ->log('Registered');
    
                        $sales_referral = SalesReferral::find($input['sales_referral_id']);
                        $sales_referral->lead_status = $input['lead_status'];
                        $sales_referral->save();
    
                        $response['success'] = '1';
                        $response['msg'] = 'Sales Referral Assign successfully';
                        $actUrl = '/client/my-lead/'. $input['sales_referral_id'];
    
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
                    }
                    else
                    {
                        $response['success'] = '2';
                        $response['errors'] = 'You are already exits this referral id';
                    }

                }
                else{
                    $response['success'] = '2';
                    $response['errors'] = 'You are already exits email';
                }
                
            }
            elseif($input['lead_status'] === '5')
            {
                $sales_referral = SalesReferral::find($input['sales_referral_id']);
                $sales_referral->lead_status = $input['lead_status'];
                $sales_referral->save();

                $response['success'] = '1';
                $response['msg'] = 'Sales Referral Modify successfully';
                $actUrl = 'sales-referral-modify-form/'. $input['sales_referral_id'];

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
            }
            else
            {
                $sales_referral = SalesReferral::find($input['sales_referral_id']);
                $sales_referral->lead_status = $input['lead_status'];
                $sales_referral->save();

                $response['success'] = '2';
                $response['errors'] = 'Sales Referral Rejected successfully';
            }
            
        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already assign sales referral';
        }
        return response()->json($response);
    }
}
