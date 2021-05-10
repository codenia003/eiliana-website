<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use View;
use Mail;
use Session;
use App\Models\SalesReferral;
use App\Models\FreelanceReferral;

class SalesController extends JoshController
{
    public function salesReferral()
    {
        return view('sales/sales-referral');
    }

    public function salesReferralForm()
    {
        if (Session::get('users')['login_as'] == '2'){
            return view('sales/sales-referral-form');
        }
        else{
            return redirect('logout');
        }

        //return view('sales/sales-referral-form');
        
    }

    public function postSalesReferralForm(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');
        $input['user_id'] = $user->id;

        $referral_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
        $input['referral_code'] = $referral_code;

        SalesReferral::create($input);

        return redirect('sales-referral')->with('success', 'Form updated successfully');
    }

    public function identifyconsultant(Request $request)
    {
        $response['success'] = '0';
        $data = $request->all();
        $leads = SalesReferral::where('sales_referral_id', $data['referral_id'])->first();

        if ($leads->lead_status == 1) {
            $response['msg'] = 'Eilian review your sales referral lead';
        } else {
            $request->session()->forget('sales_referral');
            $request->session()->put('sales_referral', $data);

            $response['success'] = '1';
            $response['msg'] = 'Sales referral process start to the next phase';
        }

        return response()->json($response);
    }

    public function freelancerReferralView()
    {
        if (Session::get('users')['login_as'] == '1'){
            return view('sales/freelancer-referral');
        }
        else{
                return redirect('logout');
        }
        
    }

    public function freelancerReferral(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');
        $input['user_id'] = $user->id;

        $referral_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6) . $user->id;
        $input['referral_link'] =  'freelancer-referral-accept/'. $referral_code;

        FreelanceReferral::create($input);

        $response['success'] = '1';
        $response['referral_link'] = url()->to('/freelancer-referral-accept') .'/'. $referral_code;
        $response['referral_code'] = $referral_code;
        $response['msg'] = 'Link created successfully';

        return response()->json($response);
    }

    public function freelancerReferralEmail(Request $request)
    {
        $input = $request->except('_token');
        $user = Sentinel::getUser();

        $freelancereferral = FreelanceReferral::where('referral_code', $input['referral_code'])->first();
        $input['user_full_name'] = $user->full_name;
        $input['email'] = $freelancereferral->email;

        Mail::send('emails.emailTemplates.otp', $input, function ($m) use ($input) {
            $m->from('info@eiliana.com', $input['user_full_name']);
            $m->to($input['email'], 'Eiliana')->subject('Referral Eiliana for Freelance');
        });

        $response['success'] = '1';
        $response['msg'] = 'Email send to user';

        return response()->json($response);

    }
}
