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
use App\Models\User;
use App\Models\Education;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\University;
use App\Models\EducationType;
use App\Models\ProjectCategory;
use stdClass;
use Carbon\Carbon;


class AdvanceSearchController extends Controller
{
    public function projects()
    {
        // Show the page
        $projectcategorys = ProjectCategory::all();
        
        return view('search/projects', compact('projectcategorys'));
    }

    public function contractStaffing(Request $request)
    {
        $user = Sentinel::getUser();
        if (empty($request->input('keyword'))) {

            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();
            return view('search/contract-staffing', compact('educationtype','qualifications','universities'));
            
        } else {
            $count = '';
            $keyword = '';
            $projects = [];
            return view('search/browse-contract-staffing', compact('count', 'projects', 'keyword'));
        } 
    }
}
