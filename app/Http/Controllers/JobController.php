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


class JobController extends Controller
{
    
    public function index()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::all();
        
        return view('job/post-job', compact('educationtype','qualifications','universities'));
    }
}
