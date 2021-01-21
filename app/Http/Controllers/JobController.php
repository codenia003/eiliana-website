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
use App\Models\ProjectsEducation;
use App\Models\ProjectsCertificate;
use App\Models\ProjectsQuestion;
use App\Models\Qualification;
use App\Models\University;
use App\Models\EducationType;
use App\Models\ProjectCategory;
use App\Models\Technology;
use App\Models\Job;
use App\Models\JobsCertificate;
use App\Models\JobsEducation;
use App\Models\JobsQuestion;
use App\Models\User;
use App\Models\Certificate;
use App\Models\ProfessionalExperience;
use App\Models\UserProject;
use App\Models\Employers;
use App\Models\Location;
use App\Models\CustomerIndustry;

class JobController extends Controller
{

    public function index()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::all();
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $customerindustries = CustomerIndustry::all();

        return view('job/post-job', compact('educationtype','qualifications','universities','technologies','locations','customerindustries'));
    }

    public function postProject()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::all();
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $customerindustries = CustomerIndustry::all();

        return view('job/post-project', compact('educationtype','qualifications','universities','technologies','locations','customerindustries'));
    }

    public function hireTalent()
    {
        $pagename = [
        	'page_title' => 'Hire Talent',
        	'lookingfor' => '1'
        ];
        $projectcategorys = ProjectCategory::all();
        $locations = Location::all();

        return view('job/hire-talent', compact('pagename','projectcategorys','locations'));
    }

    public function jobProject()
    {

        $pagename = [
        	'page_title' => 'Job Posting',
        	'lookingfor' => '2'
    	];
        $projectcategorys = ProjectCategory::all();
        $locations = Location::all();

        return view('job/job-posting', compact('pagename','projectcategorys','locations'));
    }

    public function talentSearch(Request $request){
        $data = $request->all();
        $contractsattfing = $data;
        $request->session()->forget('contractsattfing');
        $request->session()->put('contractsattfing', $contractsattfing);
        if ($data['lookingfor'] == '1') {
            // contract-sattfing
            if ($data['search_method'] == '1') {
                return redirect('/post-job');
            } else {
                return redirect('/advance-search/contract-staffing');
            }
        } else {
            // freelance-project
            if ($data['search_method'] == '1') {
                return redirect('/post-project');
            } else {
                return redirect('/advance-search/jobs');
                // return redirect('/advance-search/projects');
            }
        }
    }

    public function jobPostingSearch(Request $request){
        $data = $request->all();
        $contractsattfing = $data;
        $request->session()->forget('contractsattfing');
        $request->session()->put('contractsattfing', $contractsattfing);
        if ($data['lookingfor'] == '1') {
            // contract-sattfing
            return redirect('/post-job');
        } else {
            // freelance-project
            return redirect('/post-project');
        }
    }

    public function postJobon(Request $request) {

        $user = Sentinel::getUser();

        $input = $request->except('_token');
        $input['user_id'] = $user->id;

        $indexing = "";
        if($input['job_title'] != null) {
            $words = explode(" " ,$input['job_title']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }

        if($input['key_skills'] != null) {
            $words = explode(" " ,$input['key_skills']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }

        if($input['role_summary'] != null) {
            $words = explode(" " ,$input['role_summary']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }

        $input['indexing'] = $indexing;

        $technologty_pre = $request->input('technologty_pre');
        $technologty_pre = implode(',', $technologty_pre);
        $input['technologty_pre'] = $technologty_pre;

        $framework = $request->input('framework');
        $framework = implode(',', $framework);
        $input['framework'] = $framework;

        $jobs = new Job;
        $jobs->user_id = $user->id;
        $jobs->job_status_id = 1;
        $jobs->about_company = $input['about_company'];
        $jobs->job_title = $input['job_title'];
        $jobs->key_skills = $input['key_skills'];
        $jobs->role_summary = $input['role_summary'];
        $jobs->type_of_project = $input['type_of_project'];
        $jobs->experience_year = $input['experience_year'];
        $jobs->experience_month = $input['experience_month'];
        $jobs->customer_industry = $input['customer_industry'];
        $jobs->technologty_pre = $input['technologty_pre'];
        $jobs->framework = $input['framework'];
        $jobs->candidate_role = $input['candidate_role'];
        $jobs->product_industry_exprience = $input['product_industry_exprience'];
        $jobs->location = $input['location'];
        $jobs->budget_from = $input['budget_from'];
        $jobs->budget_to = $input['budget_to'];
        $jobs->auto_match = $input['auto_match'];
        $jobs->indexing = $input['indexing'];
        $jobs->display_status = 1;
        $jobs->save();

        $insertedId = $jobs->job_id;

        foreach ($input['education_id'] as $key => $value) {
            $education = new JobsEducation;
            $education->user_id = $user->id;
            $education->job_id = $insertedId;
            $education->education_type = $input['education_type'][$key];
            $education->graduation_type = $input['graduation_type'][$key];
            $education->name = $input['universityname'][$key];
            $education->month = $input['month'][$key];
            $education->year = $input['year'][$key];
            $education->degree = $input['degree'][$key];
            $education->save();
        }

        foreach ($input['certificate_id'] as $key => $value) {
            $certificate = new JobsCertificate;
            $certificate->user_id = $user->id;
            $certificate->job_id = $insertedId;
            $certificate->certificate_no = $input['certificate_no'][$key];
            $certificate->name = $input['certificate_name'][$key];
            $certificate->from_date = $input['from_date'][$key];
            $certificate->till_date = $input['till_date'][$key];
            $certificate->institutename = $input['institutename'][$key];
            $certificate->display_status = 1;
            $certificate->save();
        }

        foreach ($input['question_type'] as $key => $value) {

            if ($input['question_type'][$key] == '1') {
                $question_option = $input['question_radio'.$key];
            } elseif($input['question_type'][$key] == '2') {
                // $question_checkbox = $input['question_checkbox'.$key];
                // $question_checkbox = implode(',', $question_checkbox);
                // $question_option = $question_checkbox;
                $question_option = '1';
            } else {
                $question_option = $input['question_option'][$key];
            }

            $questions = new JobsQuestion;
            $questions->user_id = $user->id;
            $questions->job_id = 5;
            $questions->question_type = $input['question_type'][$key];
            $questions->question_name = $input['question_name'][$key];
            $questions->question_option = $question_option;
            $questions->display_status = 1;
            $questions->save();
        }

        return redirect('post-job')->with('success', 'Job Posted successfully');
    }

    public function postProjecton(Request $request) {

        $user = Sentinel::getUser();

        $input = $request->except('_token');
        $input['user_id'] = $user->id;

        $indexing = "";
        if($input['key_skills'] != null) {
            $words = explode(" " ,$input['key_skills']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }

        if($input['project_title'] != null) {
            $words = explode(" " ,$input['project_title']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }

        $input['indexing'] = $indexing;

        $technologty_pre = $request->input('technologty_pre');
        $technologty_pre = implode(',', $technologty_pre);
        $input['technologty_pre'] = $technologty_pre;

        $framework = $request->input('framework');
        $framework = implode(',', $framework);
        $input['framework'] = $framework;

        $current = Carbon::now();
        $projectExpires = $current->addDays(7);

        $projects = new Project;
        $projects->posted_by_user_id = $user->id;
        $projects->project_status_id = 1;
        $projects->about_company = $input['about_company'];
        $projects->project_title = $input['project_title'];
        $projects->key_skills = $input['key_skills'];
        $projects->project_summary = $input['project_summary'];
        $projects->type_of_project = $input['type_of_project'];
        $projects->experience_year = $input['experience_year'];
        $projects->experience_month = $input['experience_month'];
        $projects->customer_industry = $input['customer_industry'];
        $projects->technologty_pre = $input['technologty_pre'];
        $projects->framework = $input['framework'];
        $projects->candidate_role = $input['candidate_role'];
        $projects->product_industry_exprience = $input['product_industry_exprience'];
        $projects->location = $input['location'];
        $projects->budget_from = $input['budget_from'];
        $projects->budget_to = $input['budget_to'];
        $projects->payment_type_id = 1;
        $projects->currency_id = 1;
        $projects->language_id = 1;
        $projects->expiry_datetime = $projectExpires;
        $projects->indexing = $input['indexing'];
        $projects->save();

        $insertedId = $projects->job_id;

        foreach ($input['education_id'] as $key => $value) {
            $education = new ProjectsEducation;
            $education->user_id = $user->id;
            $education->project_id = $insertedId;
            $education->education_type = $input['education_type'][$key];
            $education->graduation_type = $input['graduation_type'][$key];
            $education->name = $input['universityname'][$key];
            $education->month = $input['month'][$key];
            $education->year = $input['year'][$key];
            $education->degree = $input['degree'][$key];
            $education->save();
        }

        foreach ($input['certificate_id'] as $key => $value) {
            $certificate = new ProjectsCertificate;
            $certificate->user_id = $user->id;
            $certificate->project_id = $insertedId;
            $certificate->certificate_no = $input['certificate_no'][$key];
            $certificate->name = $input['certificate_name'][$key];
            $certificate->from_date = $input['from_date'][$key];
            $certificate->till_date = $input['till_date'][$key];
            $certificate->institutename = $input['institutename'][$key];
            $certificate->display_status = 1;
            $certificate->save();
        }

        foreach ($input['question_type'] as $key => $value) {
            $questions = new ProjectsQuestion;
            $questions->user_id = $user->id;
            $questions->job_id = $insertedId;
            $questions->question_type = $input['question_type'][$key];
            $questions->question_name = $input['question_name'][$key];
            $questions->question_option = $input['question_option'][$key];
            $questions->display_status = 1;
            $questions->save();
        }

        return redirect('post-job')->with('success', 'Job Posted successfully');
    }

    public function getJobDeatils($id) {

        $user = User::join('professional_experience', 'users.id', '=', 'professional_experience.user_id')->where('user_id', $id)->first();

        return view('job/job-details', compact('user'));
    }

    public function getProfileDeatils($id) {

        $user = User::where('id', $id)->first();

        $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '3')->get();
        $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '4')->get();
        $certificates = Certificate::where('user_id', $id)->get();
        $proexps = ProfessionalExperience::where('user_id', $id)->first();
        $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname')->where('user_id', $id)->get();
        $employers = Employers::where('user_id', $id)->get();

        return view('job/profile-details', compact('user','ug_educations','pg_educations','certificates','proexps','projects','employers'));
    }
}
