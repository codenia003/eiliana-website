<?php
namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Sentinel;
use View;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Location;
use App\Models\Technology;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Job;
use App\Models\ProjectLeads;
use App\Models\ProjectsEducation;
use App\Models\ProjectsCertificate;
use App\Models\ProjectsQuestion;
use App\Models\EducationType;
use App\Models\Qualification;
use App\Models\University;
use App\Models\CustomerIndustry;
use App\Models\ProfessionalExperience;
use App\Models\UserProject;
use App\Models\Employers;
use App\Models\ProjectSchedule;
use App\Models\ProjectScheduleModule;
use App\Models\ProjectSubScheduleModule;
use stdClass;
use Carbon\Carbon;
use App\Notifications\UserNotification;

class ProjectController extends JoshController
{
    /**
     * Profile.
     *
     * @return View
     */

    public function postProject()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::all();
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $customerindustries = CustomerIndustry::all();
        $projectcategorys = ProjectCategory::all();

        return view('job/post-project', compact('educationtype','qualifications','universities','technologies','locations','customerindustries','projectcategorys'));
    }

    public function projectSchedule($id)
    {
        $projectleads = ProjectLeads::with('projectdetail')->where('project_leads_id', $id)->first();
        $user = User::where('id', $projectleads->from_user_id)->first();

        // return $projectleads;
        return view('project/project-schedule', compact('projectleads','user'));
    }


    public function postProjecton(Request $request)
    {
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
        $projects->project_category = $input['project_category'];
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
        $projects->referral_id = $input['referral_id'];
        $projects->save();

        $insertedId = $projects->project_id;

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

            if ($input['question_type'][$key] == '1') {
                $question_option = $input['question_radio'.$key];
            } elseif($input['question_type'][$key] == '2') {

                $question_option = '1';
            } else {
                $question_option = $input['question_option'][$key];
            }

            $questions = new ProjectsQuestion;
            $questions->user_id = $user->id;
            $questions->project_id = $insertedId;
            $questions->question_type = $input['question_type'][$key];
            $questions->question_name = $input['question_name'][$key];
            $questions->question_option = $question_option;
            $questions->display_status = 1;
            $questions->save();
        }

        return redirect('post-project')->with('success', 'Project Posted successfully');
    }

    public function postProjectSchedule(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        $input['user_id'] = $user->id;

        $projectschedules = new ProjectSchedule;
        $projectschedules->project_leads_id = $input['project_leads_id'];
        $projectschedules->project_id = $input['project_id'];
        $projectschedules->customer_objective = $input['customer_objective'];
        $projectschedules->project_start_date = $input['project_start_date'];
        $projectschedules->project_end_date = $input['project_end_date'];
        $projectschedules->remarks = $input['remarks'];
        $projectschedules->satuts = '1';
        $projectschedules->save();

        $insertedId = $projectschedules->project_schedule_id;

        foreach ($input['module_id'] as $key => $value) {

            $schedulemodule = new ProjectScheduleModule;
            $schedulemodule->project_schedule_id = $insertedId;
            $schedulemodule->module_scope = $input['module_scope'][$key];
            $schedulemodule->module_start_date = $input['module_start_date'][$key];
            $schedulemodule->module_end_date = $input['module_end_date'][$key];
            $schedulemodule->hours_proposed = $input['hours_proposed'][$key];
            $schedulemodule->hours_approved = $input['hours_approved'][$key];
            // $schedulemodule->modify_hours = $input['modify_hours'][$key];
            $schedulemodule->module_status = $input['module_status'][$key];
            $schedulemodule->save();

            $insertedScheduleId = $schedulemodule->project_schedule_module_id;

            foreach ($input['sub_module_id'] as $key1 => $value1) {

                if ($input['sub_module_id'][$key1] == $input['module_id'][$key]) {

                    $subschedulemodule = new ProjectSubScheduleModule;
                    $subschedulemodule->project_schedule_module_id = $insertedScheduleId;
                    $subschedulemodule->module_scope = $input['sub_module_scope'][$key1];
                    $subschedulemodule->module_description = $input['sub_module_description'][$key1];
                    $subschedulemodule->module_status = $input['sub_module_status'][$key1];
                    $subschedulemodule->save();
                }
            }
        }

        $project = Project::where('project_id', $input['project_id'])->first();

        $user = User::find($project->posted_by_user_id);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have project schedule response on your project',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'project/profile-projectbid/'. $input['project_id'],
            'main_id' => $input['project_id']
        ];

        Notification::send($user, new UserNotification($details));

        return redirect('/freelancer/my-project')->with('success', 'Project Schedule Posted successfully');
    }

    public function getSearchProject(Request $request)
    {
        $pagename = [
        	'page_title' => 'Project Search',
        	'lookingfor' => '1'
        ];
        $user = Sentinel::getUser();

        if (empty($request->input('lookingfor'))) {
                $technologies = Technology::where('parent_id', '0')->get();
            $projectcategorys = ProjectCategory::all();
            $locations = Location::all();

            return view('project/search-project', compact('pagename','projectcategorys','locations','technologies'));
        } else {
            $data = $request->all();
            $contractsattfing = $data;
            $request->session()->forget('contractsattfing');
            $request->session()->put('contractsattfing', $contractsattfing);

            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            if ($data['lookingfor'] == '2') {

                // if(!empty($technologty_pre)){
                //     $technologty_pre = $request->input('technologty_pre');
                //     $technologty_pre = implode(',', $technologty_pre);
                // } else {
                //     $technologty_pre = [];
                // }

                // if(!empty($framework)){
                //     $framework = $request->input('framework');
                //     $framework = implode(',', $framework);
                // } else {
                //     $framework = [];
                // }

                $projects = Project::where('project_category', '=', $data['project_category'])->paginate(10);

                $count = count($projects);

                return view('search/browse-project', compact('count', 'projects'));
            } else {

                $jobs = Job::where('indexing', 'LIKE', '%'.$sound.'%')
                    ->orWhere('experience_year', '=', $request->input('experience_year'))
                    ->orWhere('experience_month', '=', $request->input('experience_month'))
                    ->paginate(10);

                return view('search/browse-job', compact('jobs'));

            }
        }


    }

    public function getProjectDeatils($id)
    {
        $project = Project::with('companydetails','locations')->where('project_id', $id)->first();

        $selected_technologty_pre = explode(',', $project->technologty_pre);
        $selected_framework = explode(',', $project->framework);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
        $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();

        $from = strtotime($project['expiry_datetime']);
        $today = time();
        $difference = $from - $today;

        $project['expiry_days'] = floor($difference / 86400);


        return view('project/project-details', compact('project','technologies','childtechnologies'));
    }

    public function getAllProject(Request $request)
    {
        $projects = Project::where('posted_by_user_id', $request->input('user_id'))->get();
        return response()->json($projects);
    }

    public function postProjectLead(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';
        $projectleadcheck = ProjectLeads::where('project_id', '=', $input['project_id'])->where('from_user_id', '=', Sentinel::getUser()->id)->first();
        if ($projectleadcheck === null) {
            $projectleads = new ProjectLeads;
            $projectleads->project_id = $input['project_id'];
            $projectleads->from_user_id = Sentinel::getUser()->id;
            $projectleads->subject = $input['subject'];
            $projectleads->message = $input['messagetext'];
            $projectleads->notify = '0';
            $projectleads->display_status = '1';
            $projectleads->lead_status = '1';
            $projectleads->save();

            $insertedId = $input['project_id'];

            $user = User::find($input['to_user_id']);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have new project proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => 'project/project-bid-response/'. $insertedId,
                'main_id' => $insertedId
            ];

            Notification::send($user, new UserNotification($details));
            $response['success'] = '1';
            $response['msg'] = 'Proposal Submitted Successfully';

        } else {
            $response['errors'] = 'You are already submitted proposal';
        }

        return response()->json($response);

    }

    public function projectBidResponse($id) {

       $project = Project::with('companydetails','locations','projectbidresponse','projectbidresponse.fromuser','projectbidresponse.fromuser.userprofessionalexp','projectbidresponse.fromuser.userprofessionalexp.currentlocation')->where('project_id', $id)->first();

       $selected_technologty_pre = explode(',', $project->technologty_pre);
        $selected_framework = explode(',', $project->framework);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
        $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();

        return view('project/project-bids', compact('project','technologies','childtechnologies'));
    }

    public function profileProjectbid($id)
    {

        $joblead = ProjectLeads::with('projectdetail')->where('project_leads_id', $id)->first();
        $user = User::where('id', $joblead->from_user_id)->first();

        $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $joblead->from_user_id)->where('graduation_type', '3')->get();
        $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $joblead->from_user_id)->where('graduation_type', '4')->get();
        $certificates = Certificate::where('user_id', $joblead->from_user_id)->get();
        $proexps = ProfessionalExperience::where('user_id', $joblead->from_user_id)->first();
        $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname')->where('user_id', $joblead->from_user_id)->get();
        $employers = Employers::where('user_id', $joblead->from_user_id)->get();


        return view('project/profile-project-details', compact('joblead','user','ug_educations','pg_educations','certificates','proexps','projects','employers'));
    }

    public function projectLeadConvert(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $projectleadcheck = ProjectLeads::where('project_leads_id', '=', $input['lead_id'])->where('lead_status', '!=', '1')->first();
        if ($projectleadcheck === null) {

            $projectleads = ProjectLeads::find($input['lead_id']);
            $projectleads->lead_status = $input['lead_status'];
            $projectleads->save();

            if($input['lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Proposal Accepted successfully';
            } elseif($input['lead_status'] === '5') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Onhold successfully';
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Decline successfully';
            }

            $user = User::find($projectleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/project/project-schedule/'. $input['lead_id'],
                'main_id' => $input['lead_id']
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal';
        }
        return response()->json($response);

    }

    public function contractDetails()
    {
        return view('project/contract-details');
    }

}
