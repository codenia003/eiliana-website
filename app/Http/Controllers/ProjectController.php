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
use Session;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Location;
use App\Models\Currency;
use App\Models\Technology;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Job;
use App\Models\ProjectLeads;
use App\Models\ProjectBudgetAmount;
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
use App\Models\ProjectContractDetails;
use App\Models\ProjectOrderInvoice;
use App\Models\ProjectPaymentSchedule;
use App\Models\ProjectOrderFinance;
use App\Models\ProjectProposal;
use App\Models\CandidateRole;
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
        if(Session::get('users')['login_as'] == '2'){
            $educationtype = EducationType::all();
            $qualifications = Qualification::all();
            $universities = University::all();
            $technologies = Technology::where('parent_id', '0')->get();
            $locations = Location::all();
            $currency = Currency::all();
            $customerindustries = CustomerIndustry::all();
            $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
            $subprojectcategorys = ProjectCategory::all();
            $candidateroles = CandidateRole::all();
    
            return view('project/post-project', compact('educationtype','qualifications','subprojectcategorys','universities','technologies','locations','customerindustries','projectcategorys','currency','candidateroles'));
        }
        else{
            return redirect('/home');
        }
    }

    public function projectSchedule($id)
    {
        $projectleads = ProjectLeads::with('projectdetail','projectdetail.projectAmount','projectdetail.projectCurrency')->where('project_leads_id', $id)->first();
        $user = User::where('id', $projectleads->from_user_id)->first();

        //return $projectleads;
        return view('project/project-schedule', compact('projectleads','user'));
    }
    public function projectScheduleModify($id)
    {
        $projectleads = ProjectLeads::with('projectdetail','projectschedulee','projectschedulee.schedulemodulee','projectschedulee.schedulemodulee.subschedulemodulee')->where('project_leads_id', $id)->first();
        $user = User::where('id', $projectleads->from_user_id)->first();

        //return $projectleads;
        return view('project/project-schedule-modify', compact('projectleads','user'));
    }

    public function confirmationPostProjecton(Request $request)
    {
        $data = $request->all();
        $post_project_data = $data;
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $currency = Currency::all();
        $customerindustries = CustomerIndustry::all();
        $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
        $subprojectcategorys = ProjectCategory::all();

        $request->session()->forget('post_project_data');
        $request->session()->put('post_project_data', $post_project_data);
        //return redirect('confirmation-post-project')->with('post_project_data', $post_project_data)->with('subprojectcategorys', $subprojectcategorys)->with('technologies', $technologies)->with('locations', $locations)->with('projectcategorys', $projectcategorys)->with('customerindustries', $customerindustries)->with('currency', $currency);
        return view('project/confirmation-post-project', compact('post_project_data','subprojectcategorys','technologies','locations','customerindustries','projectcategorys','currency'));
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

        $technologty_pre = json_decode($request->input('technologty_pre'));
        $technologty_pre = implode(',', $technologty_pre);
        $input['technologty_pre'] = $technologty_pre;
        
        // $framework = $request->input('framework');
        // $framework = implode(',', $framework);
        // $input['framework'] = $framework;

        $current = Carbon::now();
        $projectExpires = $current->addDays(60);

        $projects = new Project;

        $projects->posted_by_user_id = $user->id;
        $projects->project_status_id = 1;
        //$projects->about_company = $input['about_company'];
        $projects->project_title = $input['project_title'];
        $projects->key_skills = $input['key_skills'];
        $projects->project_category = $input['project_category'];
        $projects->project_sub_category = $input['project_sub_category'];
        $projects->project_summary = $input['project_summary'];
        $projects->type_of_project = $input['type_of_project'];
        $projects->experience_year = $input['experience_year'];
        $projects->experience_month = $input['experience_month'];

        $projects->project_duration_min = $input['project_duration_min'];
        $projects->project_duration_max = $input['project_duration_max'];
        $projects->customer_industry = $input['customer_industry'];
        $projects->technologty_pre = $input['technologty_pre'];
        // $projects->framework = $input['framework'];
        //$projects->candidate_role = $input['candidate_role'];
        //$projects->product_industry_exprience = $input['product_industry_exprience'];
        //$projects->location = $input['location'];
        $projects->budget_from = $input['amount'];
        $projects->budget_to = $input['amount_to'];
        $projects->payment_type_id = 1;
        $projects->currency_id = 1;
        $projects->language_id = 1;
        $projects->expiry_datetime = $projectExpires;
        $projects->indexing = $input['indexing'];
        $projects->referral_id = $input['referral_id'];
        $projects->save();

        $insertedId = $projects->project_id;
        $projectBudgetAmount = new ProjectBudgetAmount;
        $projectBudgetAmount->  project_id = $insertedId;
        $projectBudgetAmount->pricing_model = $input['model_engagement'];
        $projectBudgetAmount->project_amount = $input['amount'];
        $projectBudgetAmount->project_amount_to = $input['amount_to'];
        $projectBudgetAmount->currency_id = $input['currency_id'];
        $projectBudgetAmount->save();



        // foreach ($input['education_id'] as $key => $value) {
        //     $education = new ProjectsEducation;
        //     $education->user_id = $user->id;
        //     $education->project_id = $insertedId;
        //     $education->education_type = $input['education_type'][$key];
        //     $education->graduation_type = $input['graduation_type'][$key];
        //     $education->name = $input['universityname'][$key];
        //     $education->month = $input['month'][$key];
        //     $education->year = $input['year'][$key];
        //     $education->degree = $input['degree'][$key];
        //     $education->save();
        // }

        // foreach ($input['certificate_id'] as $key => $value) {
        //     $certificate = new ProjectsCertificate;
        //     $certificate->user_id = $user->id;
        //     $certificate->project_id = $insertedId;
        //     $certificate->certificate_no = $input['certificate_no'][$key];
        //     $certificate->name = $input['certificate_name'][$key];
        //     $certificate->from_date = $input['from_date'][$key];
        //     $certificate->till_date = $input['till_date'][$key];
        //     $certificate->institutename = $input['institutename'][$key];
        //     $certificate->display_status = 1;
        //     $certificate->save();
        // }

        // foreach ($input['question_type'] as $key => $value) {

        //     if ($input['question_type'][$key] == '1') {
        //         $question_option = $input['question_radio'.$key];
        //     } elseif($input['question_type'][$key] == '2') {

        //         $question_option = '1';
        //     } else {
        //         $question_option = $input['question_option'][$key];
        //     }

        //     $questions = new ProjectsQuestion;
        //     $questions->user_id = $user->id;
        //     $questions->project_id = $insertedId;
        //     $questions->question_type = $input['question_type'][$key];
        //     $questions->question_name = $input['question_name'][$key];
        //     $questions->question_option = $question_option;
        //     $questions->display_status = 1;
        //     $questions->save();
        // }

        return redirect('post-project')->with('success', 'Project Posted successfully');
    }

    public function postProjectSchedule(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        $current = Carbon::now();
        $paymentExpires = $current->addDays(60);

        $input['user_id'] = $user->id;

        $projectschedules = new ProjectSchedule;
        $projectschedules->project_leads_id = $input['project_leads_id'];
        $projectschedules->project_id = $input['project_id'];
        $projectschedules->customer_objective = $input['customer_objective'];
        // $projectschedules->project_start_date = $input['project_start_date'];
        // $projectschedules->project_end_date = $input['project_end_date'];
        if($input['pricing_model'] == '1')
        {
            $projectschedules->hours_proposed = $input['hours_proposed'];
            $projectschedules->hours_approved = $input['hours_approved'];
        }
        else if($input['pricing_model'] == '2') {
            $projectschedules->scope_of_work = $input['scope_of_work'];
        }
        
        $projectschedules->remarks = $input['remarks'];
        $projectschedules->satuts = '1';
        $projectschedules->save();

        $insertedId = $projectschedules->project_schedule_id;

        // if($input['pricing_model'] == '3')
        // {
        //     $contractdetails = new ProjectContractDetails;
        //     $contractdetails->project_leads_id = $input['project_leads_id'];
        //     $contractdetails->from_user_id = $input['user_id'];
        //     $contractdetails->order_closed_value = '0';
        //     $contractdetails->date_acceptance = Carbon::today()->toDateString();
        //     $contractdetails->ordering_com_name = 'NA';
        //     $contractdetails->sales_comm_amount = '0';
        //     $contractdetails->remarks = $input['remarks'];
        //     $contractdetails->advance_payment_details = '0';
        //     $contractdetails->status = '1';
        //     $contractdetails->save();

        //     $contract_id = $contractdetails->contract_id;
        // }


        foreach ($input['module_id'] as $key => $value) {

            if($input['module_id'] == '1'){
                $current_pending = '1';
            } else {
                $current_pending = '0';
            }

            $schedulemodule = new ProjectScheduleModule;
            $schedulemodule->project_schedule_id = $insertedId;
            $schedulemodule->module_scope = $input['module_scope'][$key];
            // $schedulemodule->module_start_date = $input['module_start_date'][$key];
            // $schedulemodule->module_end_date = $input['module_end_date'][$key];
            if($input['pricing_model'] == '3')
            {
                $schedulemodule->payable_amount = $input['payable_amount'][$key];
                $schedulemodule->milestone_no = $input['milestone_no'][$key];
            }
            
            // $schedulemodule->hours_proposed = $input['hours_proposed'][$key];
            // $schedulemodule->hours_approved = $input['hours_approved'][$key];
            // $schedulemodule->modify_hours = $input['modify_hours'][$key];
            $schedulemodule->module_status = $input['module_status'][$key];
            $schedulemodule->current = $current_pending;
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

            // if($input['pricing_model'] == '3')
            // {
            //     $paymentschedule = new ProjectPaymentSchedule;
            //     $paymentschedule->project_leads_id = $input['project_leads_id'];
            //     $paymentschedule->contract_id = $contract_id;
            //     $paymentschedule->advance_payment = '0';
            //     $paymentschedule->installment_no = $input['module_id'][$key];
            //     $paymentschedule->installment_amount = $input['payable_amount'][$key];
            //     $paymentschedule->paymwnt_due_date = $paymentExpires;
            //     $paymentschedule->milestones_name = $input['milestone_no'][$key];
            //     $paymentschedule->status = '1';
            //     $paymentschedule->save();

            // }
        }

        $project = Project::where('project_id', $input['project_id'])->first();

        $user = User::find($project->posted_by_user_id);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have project schedule response on your proposal',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'client/project-schedule/'. $input['project_leads_id'],
            'main_id' => $input['project_leads_id']
        ];

        Notification::send($user, new UserNotification($details));

        return redirect('/freelancer/my-project')->with('success', 'Project Schedule Posted successfully');
    }

    public function updateProjectSchedule(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');
        
        $input['user_id'] = $user->id;

        $projectschedules = ProjectSchedule::find($input['project_schedule_id']);
        $projectschedules->project_leads_id = $input['project_leads_id'];
        $projectschedules->project_id = $input['project_id'];
        $projectschedules->customer_objective = $input['customer_objective'];
        // $projectschedules->project_start_date = $input['project_start_date'];
        // $projectschedules->project_end_date = $input['project_end_date'];
        if($input['pricing_model'] == '1')
        {
            $projectschedules->hours_proposed = $input['hours_proposed'];
            $projectschedules->hours_approved = $input['hours_approved'];
        }
        else if($input['pricing_model'] == '2'){
            $projectschedules->scope_of_work = $input['scope_of_work'];
        }

        $projectschedules->remarks = $input['remarks'];
        $projectschedules->satuts = '1';
        $projectschedules->save();

        $insertedId = $projectschedules->project_schedule_id;

        foreach ($input['module_id'] as $key => $value) {

            if($input['module_id'] == '1'){
                $current_pending = '1';
            } else {
                $current_pending = '0';
            }

            $schedulemodule = ProjectScheduleModule::find($input['project_schedule_id']);
            $schedulemodule->project_schedule_id = $insertedId;
            $schedulemodule->module_scope = $input['module_scope'][$key];
            // $schedulemodule->module_start_date = $input['module_start_date'][$key];
            // $schedulemodule->module_end_date = $input['module_end_date'][$key];
            if($input['pricing_model'] == '3')
            {
                $schedulemodule->milestone_no = $input['milestone_no'][$key];
            }
            else if($input['pricing_model'] == '1')
            {
                $schedulemodule->hours_proposed = $input['hours_proposed'][$key];
                $schedulemodule->hours_approved = $input['hours_approved'][$key];
            }
        
            // $schedulemodule->modify_hours = $input['modify_hours'][$key];
            $schedulemodule->module_status = $input['module_status'][$key];
            $schedulemodule->current = $current_pending;
            $schedulemodule->save();

            $insertedScheduleId = $schedulemodule->project_schedule_module_id;

            foreach ($input['sub_module_id'] as $key1 => $value1) {

                if ($input['sub_module_id'][$key1] == $input['module_id'][$key]) {

                    $subschedulemodule = ProjectSubScheduleModule::find($insertedScheduleId);
                    $subschedulemodule->project_schedule_module_id = $insertedScheduleId;
                    $subschedulemodule->module_scope = $input['sub_module_scope'][$key1];
                    $subschedulemodule->module_description = $input['sub_module_description'][$key1];
                    $subschedulemodule->module_status = $input['sub_module_status'][$key1];
                    $subschedulemodule->save();
                }
            }
        }

        $projectleadsstatus = ProjectLeads::find($input['project_leads_id']);
        $projectleadsstatus->status = '1';
        $projectleadsstatus->save();

        $project = Project::where('project_id', $input['project_id'])->first();

        $user = User::find($project->posted_by_user_id);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have project schedule response on your proposal modify',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'client/project-schedule/'. $input['project_leads_id'],
            'main_id' => $input['project_leads_id']
        ];

        Notification::send($user, new UserNotification($details));

        return redirect('/freelancer/my-project')->with('success', 'Project Schedule Updated successfully');
    }

    public function postProjectContract(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        $input['user_id'] = $user->id;

        $contractdetails = new ProjectContractDetails;
        $contractdetails->project_leads_id = $input['proposal_id'];
        $contractdetails->from_user_id = $input['user_id'];
        $contractdetails->order_closed_value = $input['order_closed_value'];
        $contractdetails->date_acceptance = $input['date_acceptance'];
        $contractdetails->ordering_com_name = $input['ordering_com_name'];
        $contractdetails->sales_comm_amount = $input['sales_comm_amount'];
        $contractdetails->remarks = $input['remarks'];
        $contractdetails->advance_payment_details = $input['advance_payment_details'];
        $contractdetails->status = '1';
        $contractdetails->save();

        $insertedId = $contractdetails->contract_id;

        $projectorderinvoice = new ProjectOrderInvoice;
        $projectorderinvoice->project_leads_id = $input['proposal_id'];
        $projectorderinvoice->contract_id = $insertedId;
        $projectorderinvoice->invoice_no = $input['invoice_no'];
        $projectorderinvoice->invoice_amount = $input['invoice_amount'];
        $projectorderinvoice->invoice_due_date = $input['invoice_due_date'];
        $projectorderinvoice->invoice_milestones = $input['invoice_milestones'];
        $projectorderinvoice->status = '1';
        $projectorderinvoice->save();

        // Mail::send('emails.emailTemplates.invoice', $data, function ($m) use ($data) {
        //     $m->from('info@eiliana.com', 'Eiliana OTP');
        //     $m->to($data['email'], 'Eiliana')->subject('OTP for Eiliana');
        // });

        foreach ($input['payment_schedule_id'] as $key => $value) {

            $paymentschedule = new ProjectPaymentSchedule;
            $paymentschedule->project_leads_id = $input['proposal_id'];
            $paymentschedule->contract_id = $insertedId;
            $paymentschedule->advance_payment = $input['advance_payment'][$key];
            $paymentschedule->installment_no = $input['payment_schedule_id'][$key];
            $paymentschedule->installment_amount = $input['installment_amount'][$key];
            $paymentschedule->paymwnt_due_date = $input['paymwnt_due_date'][$key];
            $paymentschedule->milestones_name = $input['milestones_name'][$key];
            $paymentschedule->status = '1';
            $paymentschedule->save();

        }

        $project = Project::where('project_id', $input['project_id'])->first();

        $user = User::find($project->posted_by_user_id);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have contract contract response on your proposal and invoice',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'client/project-contract-details/'. $input['proposal_id'],
            'main_id' => $input['proposal_id']
        ];

        Notification::send($user, new UserNotification($details));

        return redirect('/freelancer/my-project')->with('success', 'Project Contract updated successfully');
    }

    public function getSearchProject(Request $request)
    {
        $pagename = [
        	'page_title' => 'Project Search',
        	'lookingfor' => '1'
        ];
        $user = Sentinel::getUser();

        if (empty($request->input('lookingfor'))) {
            $technologies = Technology::where('display_status', '1')->get();
            $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
            $locations = Location::all();

            return view('project/search-project', compact('pagename','projectcategorys','locations','technologies'));
        } else {
            $data = $request->all();
            $contractsattfing = $data;
            $request->session()->forget('contractsattfing');
            $request->session()->put('contractsattfing', $contractsattfing);
         
            $sound = "";
            $words = explode(" " , $request->input('key_skills')) ;
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

                $projects = Project::with('locations','customerindustry1','projectamount','projectsubcategory','projectCurrency')->expire()->active('1')->where('project_category', '=', $data['project_category'])->where('project_sub_category', '=', $data['project_sub_category'])->paginate(10);
                
                // return $projects;
                $count = count($projects);

                return view('search/browse-project', compact('count', 'projects'));
            } else {

                // $jobs = Job::where('indexing', 'LIKE', '%'.$sound.'%')
                //     ->where('experience_year', '=', $request->input('experience_year'))
                //     ->where('experience_month', '=', $request->input('experience_month'))
                //     ->paginate(10);
                $jobs = Job::with('locations','customerindustry1')->expire()->active('1')->where('indexing', 'LIKE', '%'.$sound.'%')->paginate(10);


                return view('search/browse-job', compact('jobs'));

            }
        }
    }

    public function categoryDetails($slug, Request $request)
    {
        $pagename = [
        	'page_title' => 'Project Search',
        	'lookingfor' => '1'
        ];
        $user = Sentinel::getUser();

        if (empty($request->input('lookingfor'))) {
            $technologies = Technology::where('parent_id', '0')->get();
            $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
            $locations = Location::all();

            $autocategorie = ProjectCategory::where('slug' , $slug)->first();

            $request->session()->forget('projectcategory');
            $request->session()->put('projectcategory', $autocategorie);

            return view('project/search-project', compact('pagename','projectcategorys','locations','technologies'));
        } else {
            $data = $request->all();
            $contractsattfing = $data;
            $request->session()->forget('contractsattfing');
            $request->session()->put('contractsattfing', $contractsattfing);

            $sound = "";
            $words = explode(" " , $request->input('key_skills')) ;
            foreach($words as $word) {
                $sound .= metaphone($word);
                if (next($words)==true) {
                    $sound .= " ";
                };
            }

            if ($data['lookingfor'] == '2') {
                $projects = Project::with('locations','customerindustry1')->expire()->active('1')->where('project_category', '=', $data['project_category'])->paginate(10);
                $count = count($projects);
                return view('search/browse-project', compact('count', 'projects'));
            } else {
                $jobs = Job::with('locations','customerindustry1')->expire()->active('1')->where('indexing', 'LIKE', '%'.$sound.'%')->paginate(10);
                return view('search/browse-job', compact('jobs'));

            }
        }
    }

    public function getProjectDeatils($id)
    {
        $project = Project::with('companydetails','locations','projectAmount','projectCurrency','projectsubcategory','customerindustry1')->where('project_id', $id)->first();

        $selected_technologty_pre = explode(',', $project->technologty_pre);
        $selected_framework = explode(',', $project->framework);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
        $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();

        $from = strtotime($project['expiry_datetime']);
        $today = time();
        $difference = $from - $today;

        $project['expiry_days'] = floor($difference / 86400);

        // return $project;
        return view('project/project-details', compact('project','technologies','childtechnologies'));
    }

    public function getAllProject(Request $request)
    {
        $projects = Project::where('posted_by_user_id', $request->input('user_id'))->get();
        return response()->json($projects);
    }

    public function projectApplyLead($id)
    {
        $project = Project::with('companydetails','locations','projectAmount','projectCurrency','projectsubcategory','customerindustry1','salesreferraldetails')->where('project_id', $id)->first();
        $technologies = Technology::where('display_status', '1')->orderBy('technology_name')->get();
        //return $project;
        return view('project/project-apply', compact('project','technologies'));
    }
    
    public function projectReviseProposal($id)
    {
        //$project = Project::with('companydetails','locations','projectAmount','projectCurrency','projectsubcategory','customerindustry1')->where('project_id', $id)->first();
        $project = ProjectLeads::with('projectdetail','projectdetail.projectAmount','projectdetail.projectCurrency')->where('project_leads_id', $id)->first();
        $technologies = Technology::where('display_status', '1')->orderBy('technology_name')->get();

        //return $project;
        return view('project/project-revise-proposal', compact('project','technologies'));
    }

    public function projectAcceptProposal($id)
    {
        $project = ProjectLeads::with('projectdetail','projectdetail.projectAmount','projectdetail.projectCurrency')->where('project_leads_id', $id)->first();
        $technologies = Technology::where('display_status', '1')->orderBy('technology_name')->get();

        //return $project;
        return view('project/project-accept-proposal', compact('project','technologies'));
    }

    public function postAcceptProposal(Request $request)
    {
        $input = $request->except('_token');

        $projectleadcheck = ProjectLeads::where('project_leads_id', '=', $input['project_leads_id'])->where('lead_status', '!=', '1')->first();
        if ($projectleadcheck === null) {

            $projectleads = ProjectLeads::find($input['project_leads_id']);
            $projectleads->lead_status = '2';
            $projectleads->subject = $input['subject'];
            $projectleads->message = $input['messagetext'];
            $projectleads->save();
            
            $project_proposal = new ProjectProposal;
            $projectlead = ProjectLeads::where('project_leads_id', '=', $input['project_leads_id'])->first();
            $project_proposal->project_leads_id = $projectlead->project_leads_id;
            $project_proposal->project_id = $projectlead->project_id;
            $project_proposal->from_user_id = $projectlead->from_user_id;
            $project_proposal->subject = $projectlead->subject;
            $project_proposal->message = $projectlead->message;
            $project_proposal->lead_status = $projectlead->lead_status;
            $project_proposal->save();

            if($projectleads->lead_status == '2'){
                $actionURL = '/project/project-schedule/'. $input['project_leads_id'];
            }
            
            $insertedId = $projectleads->project_leads_id;
            $user = User::find($projectleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => $actionURL,
                'main_id' => $input['project_leads_id']
            ];

            Notification::send($user, new UserNotification($details));
            return Redirect::route('projectaccept.view', $insertedId)->with('success', 'Accept Proposal Submitted Successfully');

        } else {
            return Redirect::back()->with('error', 'You are already submitted proposal');
        }

    }

    public function postReviseProposal(Request $request)
    {
        $input = $request->except('_token');

        $projectleadcheck = ProjectLeads::where('project_leads_id', '=', $input['project_leads_id'])->first();
        if (!empty($projectleadcheck)) {

            $technologty_pre = $request->input('technologty_pre');
            $technologty_pre = implode(',', $technologty_pre);
            $input['technologty_pre'] = $technologty_pre;

            $projectleads = ProjectLeads::find($input['project_leads_id']);
            $projectleads->subject = $input['subject'];
            $projectleads->message = $input['messagetext'];
            $projectleads->bid_amount = $input['bid_amount'];
            $projectleads->technologty_pre = $input['technologty_pre'];
            $projectleads->delivery_timeline = $input['delivery_timeline'];
            $projectleads->notify = '0';
            $projectleads->display_status = '1';
            //$projectleads->lead_status = '1';
            $projectleads->save();

            $insertedId = $projectleads->project_leads_id;
            $project = Project::where('project_id', $projectleads->project_id)->first();
        
            $user = User::find($project->posted_by_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have new revise project proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => 'client/project-revise/'. $insertedId,
                'main_id' => $insertedId
            ];

            Notification::send($user, new UserNotification($details));
            return Redirect::route('projectreviseproposal.view', $insertedId)->with('success', 'Revise Proposal Submitted Successfully');

        } else {
            return Redirect::back()->with('success', 'You are already submitted proposal');
        }
    }

    public function postProjectLead(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';
        $projectleadcheck = ProjectLeads::where('project_id', '=', $input['project_id'])->where('from_user_id', '=', Sentinel::getUser()->id)->first();
        if ($projectleadcheck === null) {

            $technologty_pre = $request->input('technologty_pre');
            $technologty_pre = implode(',', $technologty_pre);
            $input['technologty_pre'] = $technologty_pre;

            $safeName = "";

            if ($request->hasFile('attach_file')) {
                $file = $request->file('attach_file');
                $extension = $file->extension()?: 'png';
                $safeName = str_random(10) . '.' . $extension;
                $destinationPath = public_path() . '/uploads/applylead/';
                $file->move($destinationPath, $safeName);
            }

            $projectleads = new ProjectLeads;
            $projectleads->project_id = $input['project_id'];
            $projectleads->from_user_id = Sentinel::getUser()->id;
            $projectleads->subject = $input['subject'];
            $projectleads->message = $input['messagetext'];
            $projectleads->bid_amount = $input['bid_amount'];

            if($input['referral_id'] != 0)
            {
                $projectleads->sales_comm_amount = $input['sales_comm_amount'];
                $projectleads->total_proposal_value = $input['total_proposal_value'];
            }
            
            $projectleads->delivery_timeline = $input['delivery_timeline'];
            $projectleads->technologty_pre = $input['technologty_pre'];
            $projectleads->attach_file = $safeName;
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
                'actionURL' => 'project/profile-projectbid/'. $projectleads->project_leads_id,
                'main_id' => $projectleads->project_leads_id
            ];

            Notification::send($user, new UserNotification($details));
            $response['success'] = '1';
            $response['msg'] = 'Proposal Submitted Successfully';
            return Redirect::route('projectlead.resposne', $insertedId)->with('success', 'Proposal Submitted Successfully');

        } else {
            return Redirect::back()->with('success', 'You are already submitted proposal');
            // $response['errors'] = 'You are already submitted proposal';
        }

        // return response()->json($response);

    }

    public function projectpplyLeadResponse($id)
    {
        $projectlead = ProjectLeads::with('projectdetail')->where('project_leads_id', $id)->first();
        return view('project/project-leadresponse', compact('projectlead'));
    }

    public function projectBidResponse($id) 
    {
        
       $project = Project::with('companydetails','locations','projectbidresponse','projectbidresponse.fromuser','projectbidresponse.fromuser.userprofessionalexp','projectbidresponse.fromuser.userprofessionalexp.currentlocation')->where('project_id', $id)->first();

        $selected_technologty_pre = explode(',', $project->technologty_pre);
        $selected_framework = explode(',', $project->framework);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
        $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();

        return view('project/project-bids', compact('project','technologies','childtechnologies'));
    }

    public function profileProjectbid($id)
    {

        $joblead = ProjectLeads::with('projectdetail','projectdetail.projectAmount','projectdetail.projectCurrency')->where('project_leads_id', $id)->first();
        $user = User::where('id', $joblead->from_user_id)->first();

        $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $joblead->from_user_id)->where('graduation_type', '3')->get();
        $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $joblead->from_user_id)->where('graduation_type', '4')->get();
        $certificates = Certificate::where('user_id', $joblead->from_user_id)->get();
        $proexps = ProfessionalExperience::where('user_id', $joblead->from_user_id)->first();
        $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname')->where('user_id', $joblead->from_user_id)->get();
        $employers = Employers::where('user_id', $joblead->from_user_id)->get();

        $selected_technologty_pre = explode(',', $joblead->technologty_pre);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();

        $other_projects = Project::where('posted_by_user_id', $joblead->projectdetail->posted_by_user_id)->where('project_id', '!=', $joblead->projectdetail->project_id)->get();
         //return $joblead;

        return view('project/profile-project-details', compact('joblead','user','ug_educations','pg_educations','certificates','proexps','projects','employers','other_projects','technologies'));
    }

    public function projectLeadConvert(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $projectleadcheck = ProjectLeads::where('project_leads_id', '=', $input['lead_id'])->where('lead_status', '!=', '1')->first();
        if ($projectleadcheck === null) {

            if($input['lead_status'] === '2'){
                $projectleads = ProjectLeads::find($input['lead_id']);
                $projectleads->lead_status = '1';
                $projectleads->save();

                $response['success'] = '1';
                $actionURL = '/project/project-accept/'. $input['lead_id'];
                //$actionURL = '/project/project-schedule/'. $input['lead_id'];
                $response['msg'] = 'Proposal Accepted successfully';
            }elseif($input['lead_status'] === '5') {
                $projectleads = ProjectLeads::find($input['lead_id']);
                $projectleads->lead_status = $input['lead_status'];
                $projectleads->save();

                $response['success'] = '1';
                $response['msg'] = 'Proposal Onhold successfully';
            }elseif($input['lead_status'] === '6') {
                $projectleads = ProjectLeads::find($input['lead_id']);
                $projectleads->lead_status = $input['lead_status'];
                $projectleads->save();

                $response['success'] = '1';
                $actionURL = '/project/project-revise/'. $input['lead_id'];
                $response['msg'] = 'Proposal Revise successfully';
            } else {
                // $projectleads = ProjectLeads::find($input['lead_id']);
                // $projectleads->lead_status = $input['lead_status'];
                // $projectleads->save();

                $response['success'] = '3';
                $response['errors'] = 'Proposal Decline successfully';
            }

            $user = User::find($projectleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your project proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => $actionURL,
                'main_id' => $input['lead_id']
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '3';
            $response['errors'] = 'You are already accept this proposal';
        }
        return response()->json($response);

    }

    public function contractDetails($id)
    {
        $projectlead = ProjectLeads::with('projectdetail','projectschedulee')->where('project_leads_id', $id)->first();

        $project_amounts = ProjectBudgetAmount::where('project_id', $projectlead->project_id)->first();
        //return $project_amounts;
        return view('project/contract-details', compact('projectlead','project_amounts'));
    }

    public function projectFinance($id)
    {
        //$projectlead = ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();
        $projectlead = ProjectLeads::with('fromuser','projectdetail','projectdetail.projectamount','projectdetail.projectCurrency','contractdetails','contractdetails.paymentschedule')->where('project_leads_id', $id)->first();
        
        if($projectlead->projectdetail->referral_id != '0')
        {
            $installment = $projectlead->contractdetails->order_closed_value;
            $commission = $projectlead->sales_comm_amount;
            $total_commission = $installment * $commission/100;
        }
        else{
            $total_commission = 0;
        }
        //return $projectlead;
        return view('project/project-finance', compact('projectlead','total_commission'));
    }

    public function projectRetainerFinance($id)
    {
        //$projectlead = ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();
        $projectlead = ProjectLeads::with('fromuser','projectdetail','projectdetail.projectamount','projectdetail.projectCurrency','contractdetails','contractdetails.paymentschedule')->where('project_leads_id', $id)->first();
        if($projectlead->projectdetail->referral_id != '0')
        {
            $gst_rate = 18;
            $price = $projectlead->total_proposal_value;
            $GST_amount = ($price * $gst_rate) / 100;
            $total_price = $price + $GST_amount;

            $installment = $projectlead->contractdetails->order_closed_value;
            $commission = $projectlead->sales_comm_amount;
            $total_commission = $installment * $commission/100;
        }
        else
        {
            $gst_rate = 18;
            $price = number_format($projectlead->contractdetails->order_closed_value, 0, ".", "");
            $GST_amount = ($price * $gst_rate) / 100;
            $total_price = $price + $GST_amount;
            $total_commission = 0;
        }
        //return $projectlead;
        return view('project/project-retainer-finance', compact('projectlead','total_price','total_commission'));
    }

    public function projectFinanceModify($id)
    {
        //$projectlead = ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();
        $projectlead = ProjectLeads::with('fromuser','projectdetail','projectdetail.projectamount','projectdetail.projectCurrency','contractdetails','contractdetails.paymentschedule')->where('project_leads_id', $id)->first();
        if($projectlead->projectdetail->referral_id != '0')
        {
            $gst_rate = 18;
            $price = $projectlead->total_proposal_value;
            $GST_amount = ($price * $gst_rate) / 100;
            $total_price = $price + $GST_amount;
        }
        else
        {
            $gst_rate = 18;
            $price = number_format($projectlead->contractdetails->order_closed_value, 0, ".", "");
            $GST_amount = ($price * $gst_rate) / 100;
            $total_price = $price + $GST_amount;
        }
        //return $projectlead;
        return view('project/project-finance-modify', compact('projectlead','total_price'));
    }

    public function sendProjectFinance(Request $request)
    {
        $input = $request->except('_token');
        //return $input;
        $orderfinancecehck = ProjectOrderFinance::where('project_leads_id', '=', $input['proposal_id'])->where('status', '=', '1')->first();
        if ($orderfinancecehck === null) {

            $orderfinmace = new ProjectOrderFinance;
            $orderfinmace->project_leads_id = $input['proposal_id'];
            $orderfinmace->contract_id = $input['contract_id'];
            //$orderfinmace->invoice_id = $input['invoice_id'];
            $orderfinmace->status = '1';
            $orderfinmace->save();

            $insertedId = $orderfinmace->order_finance_id;

            $user = User::find(1);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have one project for finance',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/admin/finance/edit/'. $input['proposal_id'],
                'main_id' => $input['proposal_id']
            ];

            Notification::send($user, new UserNotification($details));

            $success = 'success';
            $msg = 'Proposal successfully send to eiliana finance';

        } else {
            $success = 'error';
            $msg = 'You are already finance this proposal';
        }

        return redirect('/freelancer/my-project')->with($success ,  $msg);
    }

    public function updateProjectFinance(Request $request)
    {
        $input = $request->except('_token');

        $orderfinancecehck = ProjectOrderFinance::where('project_leads_id', '=', $input['proposal_id'])->where('status', '=', '1')->first();
        if ($orderfinancecehck === null) {

            if($input['model_engagement'] == '1')
            {
                $paymentschedule = ProjectPaymentSchedule::find($input['proposal_id']);
                $paymentschedule->hours_purchase = $input['hours_purchase'];
                $paymentschedule->installment_amount = $input['installment_amount'];
                $paymentschedule->total_advance_payment = $input['total_advance_payment'];
                $paymentschedule->status = '1';
                $paymentschedule->save();
            }
            elseif($input['model_engagement'] == '2')
            {
                $projectschedules = ProjectSchedule::find($input['proposal_id']);
                $projectschedules->scope_of_work = $input['scope_of_work'];
                $projectschedules->save();
                
                $paymentschedule = ProjectPaymentSchedule::find($input['proposal_id']);
                $paymentschedule->status = '1';
                $paymentschedule->save();
            }

            $user = User::find(1);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have one project modify for finance',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/admin/finance/edit/'. $input['proposal_id'],
                'main_id' => $input['proposal_id']
            ];

            Notification::send($user, new UserNotification($details));

            $success = 'success';
            $msg = 'Proposal update successfully send to eiliana finance';

        } else {
            $success = 'error';
            $msg = 'You are already finance this proposal';
        }

        return redirect('/freelancer/my-project')->with($success ,  $msg);
    }

    public function assignProject(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';

        $insertedId = $input['project_id'];

        $user = User::find($input['from_user_id']);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have assign project',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'project/'. $insertedId,
            'main_id' => $insertedId
        ];


        Notification::send($user, new UserNotification($details));
        $response['success'] = '1';
        $response['msg'] = 'Project Assign Successfully';

        return response()->json($response);

    }

    public function getProjectCategory(Request $request)
    {
        $alldata = $request->input('category_id');
        // $selected_technologies = explode(",", $alldata);
        $categoires = ProjectCategory::where('parent_id', $alldata)->get();
        return response()->json($categoires);
    }

    public function userType($slug)
    {
        if(Session::get('users')['login_as'] == '1')
        {
            return redirect('/search-project' . '/' .$slug);
        }
        elseif(Session::get('users')['login_as'] == '2'){
            return redirect('/hire-talent' . '/' .$slug);
        }
    }

    public function userSliderType()
    {
        if(Session::get('users')['login_as'] == 1)
        {
            return redirect('/search-project');
        }
        elseif(Session::get('users')['login_as'] == 2)
        {
            return redirect('/hire-talent');
        }
    }

}
