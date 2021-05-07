<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
