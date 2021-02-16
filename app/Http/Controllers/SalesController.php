<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use View;
use App\Models\SalesReferral;

class SalesController extends JoshController
{
    public function salesReferral()
    {
        return view('sales/sales-referral');
    }

    public function salesReferralForm()
    {
        return view('sales/sales-referral-form');
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
        $data = $request->all();
        $salesreferral = $data;
        $request->session()->forget('sales_referral');
        $request->session()->put('sales_referral', $salesreferral);

        $response['success'] = '1';
        $response['msg'] = 'Now process the next phase';
        return response()->json($response);
    }
}
