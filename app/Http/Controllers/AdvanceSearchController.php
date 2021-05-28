<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
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
use App\Models\Location;
use App\Models\CustomerIndustry;
use stdClass;
use Carbon\Carbon;


class AdvanceSearchController extends JoshController
{
    public function jobs(Request $request)
    {
        $user = Sentinel::getUser();
        $userlogin = $request->session()->get('users');
        $prev_tech=array();
        $contractsattfing = $request->session()->get('contractsattfing');
        if (isset($contractsattfing['rate_hour_min']) || isset($contractsattfing['rate_hour_max'])) {
           $prev_tech['rate_hour']=1;
        }
        if (isset($contractsattfing['rate_month_min']) || isset($contractsattfing['rate_month_max'])) {
           $prev_tech['rate_month']=1;
           
        }
        if (isset($contractsattfing['duration_min']) || isset($contractsattfing['duration_max'])) {
           $prev_tech['duration']=1;
        }
        if (isset($contractsattfing['project_budget_min']) || isset($contractsattfing['project_budget_maz'])) {
           $prev_tech['project_budget']=1;
        }

        if (isset($contractsattfing['project_budget_min'])) {
           $prev_tech['dur_min']=$contractsattfing['project_budget_min'];
        }
        if (isset($contractsattfing['project_budget_min'])) {
           $prev_tech['dur_max']=$contractsattfing['project_budget_min'];
        }

        if (isset($contractsattfing['technology'])) {
           $technologies = Technology::where('technology_id', $contractsattfing['technology'])->get();
            $prev_tech['name']=$technologies[0]['technology_name'];
            $prev_tech['id']=$technologies[0]['technology_id'];
        }
        // echo "<pre>";
        // print_r($prev_tech);
        // die;
        if (empty($request->input('job_category'))) {

            // Show the page
            $projectcategorys = ProjectCategory::where('parent_id', '0')->get();
            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();
            $technologies = Technology::where('parent_id', '0')->get();
            $customerindustries = CustomerIndustry::all();
            
            return view('search/jobs', compact('projectcategorys','educationtype','qualifications','universities','technologies','customerindustries','prev_tech'));

        } else {

            // print_r($request->all());

            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            if(!empty($technologty_pre)){
                $technologty_pre = $request->input('technologty_pre');
                $technologty_pre = implode(',', $technologty_pre);
            } else {
                $technologty_pre = [];
            }

            // if(!empty($framework)){
            //     $framework = $request->input('framework');
            //     $framework = implode(',', $framework);
            // } else {
            //     $framework = [];
            // }

            if($userlogin['login_as'] == '1') {
                $jobs = Job::where('indexing', 'LIKE', '%'.$sound.'%')
                    ->orWhere('job_category', '=', $request->input('job_category'))
                    ->orWhere('experience_year', '=', $request->input('experience_year'))
                    ->orWhere('experience_month', '=', $request->input('experience_month'))
                    ->orWhere('customer_industry', '=', $request->input('customer_industry'))
                    ->whereIn('technologty_pre',$technologty_pre)
                    //->whereIn('framework',$framework)
                    ->paginate(10);

                // $id = DB::table('search_keyword')->insertGetId(
                //     ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
                // );

                return view('search/browse-job', compact('jobs'));
            } else {

                $users = User::join('professional_experience', 'users.id', '=', 'professional_experience.user_id')->join('locations', 'locations.location_id', '=', 'professional_experience.current_location')->where('indexing', 'LIKE', '%'.$sound.'%')->where('id', '!=', $user->id)->select('users.*', 'professional_experience.*', 'locations.name as locationname')->paginate(10);

                // $id = DB::table('search_keyword')->insertGetId(
                //     ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
                // );
                // print_r($userlist);
                // die();
                return view('search/browse-contract-staffing', compact('users'));
            }
        }
    }

    public function projects(Request $request)
    {
        $user = Sentinel::getUser();
        if (empty($request->input('keyword'))) {

            // Show the page
            $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
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

            $projects = Project::where('indexing', 'LIKE', '%'.$sound.'%')->paginate(10);

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
            $customerindustries = CustomerIndustry::all();
            $locations = Location::all();
            return view('search/contract-staffing', compact('educationtype','qualifications','universities','locations','technologies','customerindustries'));

        } else {
            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            $users = User::join('professional_experience', 'users.id', '=', 'professional_experience.user_id')->where('indexing', 'LIKE', '%'.$sound.'%')->where('id', '!=', $user->id)->paginate(10);

            $id = DB::table('search_keyword')->insertGetId(
                ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
            );
            // print_r($userlist);
            // die();
            return view('search/browse-contract-staffing', compact('users'));
        }
    }
}
