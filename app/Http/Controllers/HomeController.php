<?php

namespace App\Http\Controllers;


use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Mail\TeamInvite;
use Sentinel;
use View;
use URL;
use Mail;
use App\Models\Job;

class HomeController extends JoshController
{
    public function index()
    {
        $jobs = Job::with('companydetails','locations')->latest()->limit(1)->get();
        // return $jobs;
        return view('index', compact('jobs'));
    }
}
