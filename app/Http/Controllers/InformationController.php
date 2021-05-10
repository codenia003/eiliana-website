<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class InformationController extends JoshController
{

    public function privacy(){
        return view('information.privacy-policy');
    }

    public function howItsWork(){
        return view('information.howitswork');
    }

    public function help(){
        return view('information.help');
    }

    public function pricingPlan(){
        return view('information.pricing');
    }

    public function about (){
        return view('information.about');
    }

    public function careers (){
        return view('information.careers');
    }

    public function customers (){
        return view('information.customers');
    }

    public function hireUs (){
        return view('information.hire-us');
    }

    public function termsAndConditions (){
        return view('information.terms-and-conditions');
    }

    public function teams (){
        return view('information.teams');
    }

    public function welcome (){
        return view('information.welcome');
    }

    public function contactUs (){
        return view('information.contact-us');
    }

    public function contactUsSave(Request $request)
    {
        $input = $request->except('_token');
        $contactus = new ContactUs;
        $contactus->name  = $input['name'];
        $contactus->email  = $input['email'];
        $contactus->phone_no  = $input['phone_no'];
        $contactus->message  = $input['message'];
        $contactus->save();
        return redirect('contact-us')->with('success', 'You have successfully save data!');
    }

}
