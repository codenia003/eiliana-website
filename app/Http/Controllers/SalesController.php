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

        SalesReferral::create($input);

        return redirect('sales-referral')->with('success', 'Form updated successfully');
    }
}
