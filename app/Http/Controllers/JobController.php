<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Reminder;
use Sentinel;
use URL;
use Validator;
use View;
use DB;
use stdClass;
use Carbon\Carbon;
use App\Models\Education;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\University;
use App\Models\EducationType;
use App\Models\ProjectCategory;


class JobController extends Controller
{

    public function index()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::all();

        return view('job/post-job', compact('educationtype','qualifications','universities'));
    }

    public function hireTalent()
    {

        $pagename = [
        	'page_title' => 'Hire Talent',
        	'lookingfor' => '1'
        ];
        $projectcategorys = ProjectCategory::all();

        return view('job/hire-talent', compact('pagename','projectcategorys'));
    }

    public function jobProject()
    {

        $pagename = [
        	'page_title' => 'Job Posting',
        	'lookingfor' => '2'
    	];

        return view('job/job-posting', compact('pagename'));
    }

    public function talentSearch(Request $request){
        $data = $request->all();
        if ($data['lookingfor'] == '1') {
            // contract-sattfing
            $contractsattfing = $data;
            $request->session()->forget('contractsattfing');
            $request->session()->put('contractsattfing', $contractsattfing);
            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();

            // return view('search/contract-staffing', compact('contractsattfing','educationtype','qualifications','universities'));
            return redirect('/advance-search/contract-staffing');
        } else {
            // freelance
            echo 'Working on';
        }


    }
}
