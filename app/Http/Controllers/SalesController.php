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
use App\Models\CustomerIndustry;
use DB;

class SalesController extends JoshController
{
    public function salesReferral()
    {
        return view('sales/sales-referral');
    }

    public function salesReferralForm()
    {
        if (Session::get('users')['login_as'] == '2'){
            $company_types = DB::table('roles')->where('id', '!=', '1')->where('id', '!=', '2')->where('id', '!=', '3')->where('id', '!=', '7')->get();
            $customer_industries = CustomerIndustry::all();
            return view('sales/sales-referral-form', compact('company_types','customer_industries'));
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

    public function ModifySalesReferralForm($id)
    {
        if (Session::get('users')['login_as'] == '2'){
            $sales_referral = SalesReferral::where('sales_referral_id', $id)->first();
            $company_types = DB::table('roles')->where('id', '!=', '1')->where('id', '!=', '2')->where('id', '!=', '3')->where('id', '!=', '7')->get();
            $customer_industries = CustomerIndustry::all();
            //return $sales_referral;
            return view('sales/sales-referral-modify-form', compact('sales_referral','company_types','customer_industries'));
        }
        else{
            return redirect('logout');
        }
        
    }

    public function updateSalesReferralForm(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        $sales_referral = SalesReferral::find($input['sales_referral_id']);
        $sales_referral->company_name = $input['company_name'];
        $sales_referral->legal_status = $input['legal_status'];
        $sales_referral->contact_person = $input['contact_person'];
        $sales_referral->designation = $input['designation'];
        $sales_referral->email = $input['email'];
        $sales_referral->mobile_no = $input['mobile_no'];
        $sales_referral->website_address = $input['website_address'];
        $sales_referral->requirment_details = $input['requirment_details'];
        $sales_referral->customer_industry = $input['customer_industry'];
        $sales_referral->datetimeconnect = $input['datetimeconnect'];
        $sales_referral->confirmed = $input['confirmed'];
        $sales_referral->commission_type = $input['commission_type'];
        $sales_referral->expected_commission = $input['expected_commission'];
        $sales_referral->lead_status = '1';
        $sales_referral->save();

        return redirect('sales-referral')->with('success', 'Modify sales referral form successfully');
    }

    public function identifyconsultant(Request $request)
    {
        $response['success'] = '0';
        $data = $request->all();
        $leads = SalesReferral::where('sales_referral_id', $data['referral_id'])->first();

        if ($leads->lead_status == 1) {
            $response['msg'] = 'Eiliana review your sales referral lead';
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
