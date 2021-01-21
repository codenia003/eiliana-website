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
use App\Models\Technology;
use App\Models\Job;
use stdClass;
use Carbon\Carbon;


class AdvanceSearchController extends Controller
{
    public function jobs(Request $request)
    {
        $user = Sentinel::getUser();
        if (empty($request->input('keyword'))) {

            // Show the page
            $projectcategorys = ProjectCategory::all();
            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();
            $technologies = Technology::where('parent_id', '0')->get();
            return view('search/jobs', compact('projectcategorys','educationtype','qualifications','universities','technologies'));

        } else {
            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            $jobs = Job::where('indexing', 'LIKE', '%'.$sound.'%')->get();

            // $id = DB::table('search_keyword')->insertGetId(
            //     ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
            // );

            return view('search/browse-job', compact('jobs'));

        }
    }

    public function projects(Request $request)
    {
        $user = Sentinel::getUser();
        if (empty($request->input('keyword'))) {

            // Show the page
            $projectcategorys = ProjectCategory::all();
            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();
            $technologies = Technology::where('parent_id', '0')->get();
            return view('search/projects', compact('projectcategorys','educationtype','qualifications','universities','technologies'));

        } else {
            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            $projects = Project::where('indexing', 'LIKE', '%'.$sound.'%')->get();

            // $id = DB::table('search_keyword')->insertGetId(
            //     ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
            // );

            return view('search/browse-project', compact('projects'));

        }
    }

    public function contractStaffing(Request $request)
    {
        $user = Sentinel::getUser();
        if (empty($request->input('keyword'))) {

            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();
            $technologies = Technology::where('parent_id', '0')->get();
            return view('search/contract-staffing', compact('educationtype','qualifications','universities','technologies'));

        } else {
            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            $users = User::join('professional_experience', 'users.id', '=', 'professional_experience.user_id')->where('indexing', 'LIKE', '%'.$sound.'%')->get();
            $id = DB::table('search_keyword')->insertGetId(
                ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
            );
            // print_r($userlist);
            // die();
            return view('search/browse-contract-staffing', compact('users'));
        }
    }
}
