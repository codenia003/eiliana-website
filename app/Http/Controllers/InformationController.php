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

}
