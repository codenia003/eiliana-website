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
use Session;
use View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use stdClass;
use Carbon\Carbon;
use App\Models\Education;
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
use App\Models\ContractStaffingLeads;
use App\Models\ContractualJobSchedule;
use App\Models\JobLeads;
use App\Models\SaveJob;
use App\Models\JobProposal;
use App\Models\JobOrderFinance;
use App\Models\JobContractDetails;
use App\Models\JobOrderInvoice;
use App\Models\JobPaymentSchedule;
use App\Models\CandidateRole;
use PDF;
use App\Notifications\UserNotification;

class JobController extends JoshController
{

    public function index()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::all();
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $customerindustries = CustomerIndustry::all();
        $candidateroles = CandidateRole::all();
        $jobcategorys = ProjectCategory::where('parent_id' , '0')->get();

        return view('job/post-job', compact('educationtype','qualifications','universities','technologies','locations','customerindustries','candidateroles','jobcategorys'));
    }
    public function hireTalent(Request $request)
    {

        $pagename = [
        	'page_title' => 'Hire Talent',
        	'lookingfor' => '1'
        ];

        $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
        $locations = Location::all();
        $technologies = Technology::all();

        $request->session()->forget('sales_referral');

        return view('job/hire-talent', compact('pagename','projectcategorys','locations','technologies'));
    }

    public function categoryDetails($slug, Request $request)
    {
        $pagename = [
        	'page_title' => 'Hire Talent',
        	'lookingfor' => '1'
        ];
        $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
        $locations = Location::all();

        $autocategorie = ProjectCategory::where('slug' , $slug)->first();

        $request->session()->forget('sales_referral');

        $request->session()->forget('projectcategory');
        $request->session()->put('projectcategory', $autocategorie);

        return view('job/hire-talent', compact('pagename','projectcategorys','locations'));
    }

    public function hireTalentSales(Request $request)
    {

        $pagename = [
        	'page_title' => 'Hire Talent',
        	'lookingfor' => '1'
        ];
        $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
        $locations = Location::all();

        return view('job/hire-talent', compact('pagename','projectcategorys','locations'));
    }

    public function jobProject(Request $request)
    {
        if(Session::get('users')['login_as'] == '2'){
            $pagename = [
                'page_title' => 'Job Posting',
                'lookingfor' => '2'
            ];
            $projectcategorys = ProjectCategory::where('parent_id' , '0')->get();
            $locations = Location::all();

            $request->session()->forget('sales_referral');

            return view('job/job-posting', compact('pagename','projectcategorys','locations'));
        }
        else{
            return redirect('/account/login');
        }
    }

    public function talentSearch(Request $request) {

        $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // die;
        $contractsattfing = $data;
        $request->session()->forget('contractsattfing');
        $request->session()->put('contractsattfing', $contractsattfing);

        $roleda = $request->session()->get('users');
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
                if($roleda['role'] == '2') {
                    return redirect('/advance-search/jobs');
                } else {
                    return redirect('/advance-search/projects');
                }
            }
        }
    }

    public function jobPostingSearch(Request $request){

        if(Session::get('users')['login_as'] == '2'){
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
        else{
            return redirect('/account/login');
        }
    }

    public function confirmationPostJobon(Request $request)
    {
        $data = $request->all();
        $post_job_data = $data;
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $customerindustries = CustomerIndustry::all();

        $request->session()->forget('post_job_data');
        $request->session()->put('post_job_data', $post_job_data);
        //return redirect('confirmation-post-project')->with('post_project_data', $post_project_data)->with('subprojectcategorys', $subprojectcategorys)->with('technologies', $technologies)->with('locations', $locations)->with('projectcategorys', $projectcategorys)->with('customerindustries', $customerindustries)->with('currency', $currency);
        return view('job/confirmation-post-job', compact('post_job_data','technologies','locations','customerindustries'));
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

        // $framework = $request->input('framework');
        // $framework = implode(',', $framework);
        // $input['framework'] = $framework;

        $current = Carbon::now();
        $jobExpires = $current->addDays(60);

        $jobs = new Job;
        $jobs->user_id = $user->id;
        $jobs->job_status_id = 1;
        $jobs->about_company = $input['about_company'];
        $jobs->contract_duration = $input['contract_duration'];
        $jobs->job_title = $input['job_title'];
        $jobs->key_skills = $input['key_skills'];
        $jobs->role_summary = $input['role_summary'];
        //$jobs->type_of_project = $input['type_of_project'];
        $jobs->experience_year = $input['experience_year'];
        $jobs->experience_month = $input['experience_month'];
        //$jobs->customer_industry = $input['customer_industry'];
        $jobs->technologty_pre = $input['technologty_pre'];
        //$jobs->job_category = $input['job_category'];
        //$jobs->job_sub_category = $input['job_sub_category'];
        //$jobs->framework = $input['framework'];
        //$jobs->candidate_role = $input['candidate_role'];
        $jobs->product_industry_exprience = $input['product_industry_exprience'];
        $jobs->location = $input['location'];
        //$jobs->model_engagement = $input['model_engagement'];
        $jobs->budget_from = $input['budget_from'];
        $jobs->budget_to = $input['budget_to'];
        //$jobs->auto_match = $input['auto_match'];
        $jobs->indexing = $input['indexing'];
        $jobs->referral_id = $input['referral_id'];
        $jobs->display_status = 1;
        $jobs->expiry_datetime = $jobExpires;
        $jobs->save();

        $insertedId = $jobs->job_id;
        // $freelance_id = JobLeads::first();

        // if($insertedId != 0) {
        //     $users = User::find($freelance_id->from_user_id);
        //     $details = [
        //         'greeting' => 'Hi '. $users->full_name,
        //         'body' => 'You have response on your contractual job proposal',
        //         'thanks' => 'Thank you for using eiliana.com!',
        //         'actionText' => 'View My Site',
        //         'actionURL' => '/freelancer/contractual-job-inform/'. $freelance_id->job_leads_id .'&'. 'job_id='. $insertedId,
        //         'main_id' => $freelance_id->job_leads_id
        //     ];

        //     Notification::send($users, new UserNotification($details));
        //  }

        // foreach ($input['education_id'] as $key => $value) {
        //     $education = new JobsEducation;
        //     $education->user_id = $user->id;
        //     $education->job_id = $insertedId;
        //     $education->education_type = $input['education_type'][$key];
        //     $education->graduation_type = $input['graduation_type'][$key];
        //     $education->name = $input['universityname'][$key];
        //     $education->month = $input['month'][$key];
        //     $education->year = $input['year'][$key];
        //     $education->degree = $input['degree'][$key];
        //     $education->save();
        // }

        // foreach ($input['certificate_id'] as $key => $value) {
        //     $certificate = new JobsCertificate;
        //     $certificate->user_id = $user->id;
        //     $certificate->job_id = $insertedId;
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
        //         // $question_checkbox = $input['question_checkbox'.$key];
        //         // $question_checkbox = implode(',', $question_checkbox);
        //         // $question_option = $question_checkbox;
        //         $question_option = '1';
        //     } else {
        //         $question_option = $input['question_option'][$key];
        //     }

        //     $questions = new JobsQuestion;
        //     $questions->user_id = $user->id;
        //     $questions->job_id = 5;
        //     $questions->question_type = $input['question_type'][$key];
        //     $questions->question_name = $input['question_name'][$key];
        //     $questions->question_option = $question_option;
        //     $questions->display_status = 1;
        //     $questions->save();
        // }

        return redirect('post-job')->with('success', 'Job Posted successfully');
    }

    public function getJobDeatils($id) {

        $job = Job::with('companydetails','locations','jobseducation','jobseducation.educationtype','jobscertificate','jobsquestion')->where('job_id', $id)->first();

        $selected_technologty_pre = explode(',', $job->technologty_pre);
        $selected_framework = explode(',', $job->framework);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
        $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();
        $savejob = SaveJob::where('job_id', '=', $id)->where('user_id', '=', Sentinel::getUser()->id)->first();
        //return $job;
        return view('job/job-details', compact('job','technologies','childtechnologies','savejob'));
    }

    public function jobLeadResponse($id) {

        $job = Job::with('companydetails','locations','jobleadresponse','jobleadresponse.fromuser','jobleadresponse.fromuser.userprofessionalexp','jobleadresponse.fromuser.userprofessionalexp.currentlocation')->where('job_id', $id)->first();

        $selected_technologty_pre = explode(',', $job->technologty_pre);
        $selected_framework = explode(',', $job->framework);
        $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
        $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();
        // return $job;

        return view('job/job-leadres', compact('job','technologies','childtechnologies'));
    }

    public function getProfileDeatils($id) {

        $user = User::where('id', $id)->first();

        $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '3')->get();
        $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '4')->get();
        $certificates = Certificate::where('user_id', $id)->get();
        $proexps = ProfessionalExperience::where('user_id', $id)->first();
        $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname')->where('user_id', $id)->get();
        $employers = Employers::where('user_id', $id)->get();
        $staffingleadsid = ContractStaffingLeads::all()->last()->staffing_leads_id;
        $staffingleadsid = $staffingleadsid + 1;

        $staffingleadcheck = ContractStaffingLeads::where('from_user_id', '=', Sentinel::getUser()->id)->where('to_user_id', '=', $id)->first();

        if ($staffingleadcheck === null) {
            $response['leadcheck'] = '0';
        } else {
            if($staffingleadcheck['lead_status'] == '1'){
                $response['leadcheck'] = '0';
            } else {
                $response['leadcheck'] = '1';
            }
        }

        return view('job/profile-details', compact('user','ug_educations','pg_educations','certificates','proexps','projects','employers','staffingleadsid','response'));
    }

    public function profileJobLead($id)
    {

        $joblead = JobLeads::with('jobdetail')->where('job_leads_id', $id)->first();
        $user = User::where('id', $joblead->from_user_id)->first();

        $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $joblead->from_user_id)->where('graduation_type', '3')->get();
        $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $joblead->from_user_id)->where('graduation_type', '4')->get();
        $certificates = Certificate::where('user_id', $joblead->from_user_id)->get();
        $proexps = ProfessionalExperience::where('user_id', $joblead->from_user_id)->first();
        $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname')->where('user_id', $joblead->from_user_id)->get();
        $employers = Employers::where('user_id', $joblead->from_user_id)->get();
        $other_jobs = Job::where('user_id', $joblead->jobdetail->user_id)->where('job_id', '!=', $joblead->jobdetail->job_id)->get();

        //return  $joblead;

        return view('job/profile-job-details', compact('joblead','user','ug_educations','pg_educations','certificates','proexps','projects','employers','other_jobs'));
    }

    public function postStaffingLead(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';
        $staffingleadcheck = ContractStaffingLeads::where('from_user_id', '=', Sentinel::getUser()->id)->where('to_user_id', '=', $input['to_user_id'])->first();
        if ($staffingleadcheck === null) {
            $staffingleads = new ContractStaffingLeads;
            $staffingleads->from_user_id = Sentinel::getUser()->id;
            $staffingleads->to_user_id = $input['to_user_id'];
            $staffingleads->subject = $input['subject'];
            $staffingleads->message = $input['messagetext'];
            $staffingleads->notify = '0';
            $staffingleads->display_status = '1';
            $staffingleads->lead_status = '1';
            $staffingleads->referral_id = $input['referral_id'];
            $staffingleads->save();

            $insertedId = $staffingleads->staffing_leads_id;

            $user = User::find($input['to_user_id']);

            $details = [
                'greeting' => 'Hi '. $input['toname'],
                'body' => 'You have new opportunity',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => 'staffing-lead-response/'. $insertedId,
                'main_id' => $insertedId
            ];

            Notification::send($user, new UserNotification($details));

            Mail::send('emails.emailTemplates.staffingleads', $input, function ($m) use ($input) {
                $m->from('info@eiliana.com', $input['fromname']);
                $m->to($input['toemail'], $input['toname'])->subject('New Job Application From ');
            });
            $response['success'] = '1';
            $response['msg'] = 'Proposal Submitted Successfully';
        } else {
            $response['errors'] = 'You are already connected to this user';
        }

        return response()->json($response);

    }

    public function staffingLeadResponse($id) {

        $staffingleads = ContractStaffingLeads::where('staffing_leads_id', $id)->first();

        $user = User::where('id', $staffingleads->from_user_id)->first();
        return view('job/stafflead-response', compact('user','staffingleads'));
    }

    public function staffingLeadConvert(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $staffingleadcheck = ContractStaffingLeads::where('staffing_leads_id', '=', $input['lead_id'])->where('lead_status', '=', $input['lead_status'])->first();
        if ($staffingleadcheck === null) {

            $staffingleads = ContractStaffingLeads::find($input['lead_id']);
            $staffingleads->lead_status = $input['lead_status'];
            $staffingleads->save();

            if($input['lead_status'] === '2'){
                $response['success'] = '1';
                $response['msg'] = 'Opportunity Accepted successfully';
                // $response['redirect'] = 'Opportunity Accepted successfully';
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Opportunity Decline';
                // $response['redirect'] = 'Opportunity Decline';
            }

            $user = User::find($staffingleads->from_user_id);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have response on your proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/staffing-lead-response',
                'main_id' => $input['lead_id']
            ];

            Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already reply to this user';
        }
        return response()->json($response);

    }

    public function jobLeadConvert(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $jobleadcheck = JobLeads::where('job_leads_id', '=', $input['lead_id'])->where('lead_status', '!=', '1')->first();
        if ($jobleadcheck === null) {

            $jobleads = JobLeads::find($input['lead_id']);
            $jobleads->lead_status = $input['lead_status'];
            $jobleads->save();


            if($input['lead_status'] === '2'){

                $job_proposal = new JobProposal;
                $joblead = JobLeads::where('job_leads_id', '=', $input['lead_id'])->first();
                $job_proposal->job_leads_id = $joblead->job_leads_id;
                $job_proposal->job_id = $joblead->job_id;
                $job_proposal->from_user_id = $joblead->from_user_id;
                $job_proposal->subject = $joblead->subject;
                $job_proposal->message = $joblead->message;
                $job_proposal->lead_status = $joblead->lead_status;
                $job_proposal->save();

                $response['success'] = '1';
                $response['msg'] = 'Proposal Accepted successfully';
            } elseif($input['lead_status'] === '5') {
                $response['success'] = '1';
                $response['msg'] = 'Proposal Onhold successfully';
            } else {
                $response['success'] = '2';
                $response['errors'] = 'Proposal Decline successfully';
            }


            $users = User::find($jobleads->from_user_id);
            $details = [
                'greeting' => 'Hi '. $users->full_name,
                'body' => 'You have response on your contractual job proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/freelancer/contractual-job-inform/'. $input['lead_id'],
                'main_id' => $input['lead_id']
            ];

            Notification::send($users, new UserNotification($details));


            // $user = User::find($jobleads->from_user_id);

            // $details = [
            //     'greeting' => 'Hi '. $user->full_name,
            //     'body' => 'You have response on your job proposal',
            //     'thanks' => 'Thank you for using eiliana.com!',
            //     'actionText' => 'View My Site',
            //     'actionURL' => '/freelancer/my-proposal',
            //     'main_id' => $input['lead_id']
            // ];

            // Notification::send($user, new UserNotification($details));

        } else {
            $response['success'] = '2';
            $response['errors'] = 'You are already accept this proposal';
        }
        return response()->json($response);

    }

    public function postJobLead(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';
        $jobleadcheck = JobLeads::where('job_id', '=', $input['job_id'])->where('from_user_id', '=', Sentinel::getUser()->id)->first();
        if ($jobleadcheck === null) {
            $jobleads = new JobLeads;
            $jobleads->job_id = $input['job_id'];
            $jobleads->from_user_id = Sentinel::getUser()->id;
            $jobleads->application_date = $input['application_date'];
            $jobleads->expected_ctc = $input['expected_ctc'];
            $jobleads->notice_period = $input['notice_period'];
            $jobleads->subject = $input['subject'];
            $jobleads->message = $input['messagetext'];
            $jobleads->notify = '0';
            $jobleads->display_status = '1';
            $jobleads->lead_status = '1';
            $jobleads->save();

            $insertedId = $input['job_id'];

            $user = User::find($input['to_user_id']);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have new job proposal',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => 'job/job-lead-response/'. $insertedId,
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


    public function jobFinance($id)
    {
        $joblead = JobLeads::with('jobdetail','jobcontractdetails','jobcontractdetails.joborderinvoice','jobcontractdetails.jobpaymentschedule','jobcontractdetails.jobadvacne_amount')->where('job_leads_id', $id)->first();
        return view('job/job-finance', compact('joblead'));
    }

    public function sendJobFinance(Request $request)
    {
        $input = $request->except('_token');

        $orderfinancecehck = JobOrderFinance::where('job_leads_id', '=', $input['job_leads_id'])->where('status', '=', '1')->first();
        if ($orderfinancecehck === null) {

            $orderfinmace = new JobOrderFinance;
            $orderfinmace->job_leads_id = $input['job_leads_id'];
            $orderfinmace->contract_id = $input['contract_id'];
            $orderfinmace->invoice_id = $input['invoice_id'];
            $orderfinmace->status = '1';
            $orderfinmace->save();

            $insertedId = $orderfinmace->job_order_id;

            $user = User::find(1);

            $details = [
                'greeting' => 'Hi '. $user->full_name,
                'body' => 'You have one job for finance',
                'thanks' => 'Thank you for using eiliana.com!',
                'actionText' => 'View My Site',
                'actionURL' => '/admin/job_finance/edit/'. $insertedId,
                'main_id' => $insertedId
            ];

            Notification::send($user, new UserNotification($details));

            $success = 'success';
            $msg = 'Job Proposal successfully send to eiliana finance';

        } else {
            $success = 'error';
            $msg = 'You are already finance this job proposal';
        }

        return redirect('/freelancer/my-proposal')->with($success ,  $msg);
    }


    public function JobContractDetails($id)
    {
        $joblead = JobLeads::with('jobdetail')->where('job_leads_id', $id)->first();
        //return $joblead;
        return view('job/job-contract-details', compact('joblead'));
    }

    public function postJobContract(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        $input['user_id'] = $user->id;

        $contractdetails = new JobContractDetails;
        $contractdetails->job_leads_id = $input['job_leads_id'];
        $contractdetails->from_user_id = $input['user_id'];
        $contractdetails->order_closed_value = $input['order_closed_value'];
        $contractdetails->date_acceptance = $input['date_acceptance'];
        $contractdetails->ordering_com_name = $input['ordering_com_name'];
        $contractdetails->remarks = $input['remarks'];
        $contractdetails->advance_payment_details = $input['advance_payment_details'];
        $contractdetails->status = '1';
        $contractdetails->save();

        $insertedId = $contractdetails->contract_id;

        $projectorderinvoice = new JobOrderInvoice;
        $projectorderinvoice->job_leads_id = $input['job_leads_id'];
        $projectorderinvoice->contract_id = $insertedId;
        $projectorderinvoice->invoice_no = $input['invoice_no'];
        $projectorderinvoice->invoice_amount = $input['invoice_amount'];
        $projectorderinvoice->invoice_due_date = $input['invoice_due_date'];
        $projectorderinvoice->invoice_milestones = $input['invoice_milestones'];
        $projectorderinvoice->status = '1';
        $projectorderinvoice->save();

        foreach ($input['payment_schedule_id'] as $key => $value) {

            $paymentschedule = new JobPaymentSchedule;
            $paymentschedule->job_leads_id = $input['job_leads_id'];
            $paymentschedule->contract_id = $insertedId;
            $paymentschedule->advance_payment = $input['advance_payment'][$key];
            $paymentschedule->installment_no = $input['payment_schedule_id'][$key];
            $paymentschedule->installment_amount = $input['installment_amount'][$key];
            $paymentschedule->paymwnt_due_date = $input['paymwnt_due_date'][$key];
            $paymentschedule->milestones_name = $input['milestones_name'][$key];
            $paymentschedule->status = '1';
            $paymentschedule->save();

        }

        $job = Job::where('job_id', $input['job_id'])->first();

        $user = User::find($job->user_id);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have job contract response on your proposal',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'client/job-contract-details/'. $input['job_leads_id'],
            'main_id' => $input['job_leads_id']
        ];

        Notification::send($user, new UserNotification($details));

        return redirect('/freelancer/my-project')->with('success', 'Job Contract updated successfully');
    }

    public function SaveJob(Request $request) {

        $input = $request->except('_token');
        $response['success'] = '0';

        $savejobcheck = SaveJob::where('job_id', '=', $input['job_id'])->where('user_id', '=', Sentinel::getUser()->id)->first();
        if ($savejobcheck === null) {
            $savejob = new SaveJob;
            $savejob->job_id = $input['job_id'];
            $savejob->user_id = Sentinel::getUser()->id;
            $savejob->save();

            $response['success'] = '1';
            $response['msg'] = 'Save Job successfully';

        } else {
            //$response['success'] = '1';
            $response['errors'] = 'You are already save this job';
        }
        return response()->json($response);

    }

    public function assignJob(Request $request){

        $input = $request->except('_token');
        $response['success'] = '0';

        $insertedId = $input['job_id'];

        $user = User::find($input['from_user_id']);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have assign job',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'job/'. $insertedId,
            'main_id' => $insertedId
        ];


        Notification::send($user, new UserNotification($details));
        $response['success'] = '1';
        $response['msg'] = 'Job Assign Successfully';

        return response()->json($response);

    }

    public function ContractualJobInformModify($id)
    {
        $contractual_job = ContractualJobSchedule::where('job_leads_id', $id)->first();
        $locations = Location::all();
        return view('job/job-schedule-modify', compact('contractual_job','locations'));
    }

    public function updateJobSchedule(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        $input['user_id'] = $user->id;

        $jobschedules = ContractualJobSchedule::where('job_leads_id', $input['job_leads_id'])->first();
        $jobschedules->price = $input['price'];
        $jobschedules->contract_duration = $input['contract_duration'];
        $jobschedules->pricing_cycle = $input['pricing_cycle'];

        if($input['pricing_cycle'] == '2')
        {
             $jobschedules->on_postpaid_amount = $input['on_postpaid_amount'];
             $jobschedules->advance_amount = $input['advance_amount'];
        }

        $jobschedules->location = $input['location'];
        $jobschedules->satuts = '1';
        $jobschedules->save();

        $job = Job::where('job_id', $input['job_id'])->first();

        $user = User::find($job->user_id);

        $details = [
            'greeting' => 'Hi '. $user->full_name,
            'body' => 'You have job schedule response on your proposal modify',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => 'client/contractual-job-inform/'. $input['job_leads_id'],
            'main_id' => $input['job_leads_id']
        ];

        Notification::send($user, new UserNotification($details));

        return redirect('/freelancer/my-proposal')->with('success', 'Job Schedule Updated successfully');
    }

    public function getResume() {

        $user = Sentinel::getUser();
        $id = $user->id;

        $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '3')->get();
        $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '4')->get();
        $certificates = Certificate::where('user_id', $id)->get();
        $proexps = ProfessionalExperience::where('user_id', $id)->first();
        $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname')->where('user_id', $id)->get();
        $employers = Employers::where('user_id', $id)->get();
        // $staffingleadsid = ContractStaffingLeads::all()->last()->staffing_leads_id;
        // $staffingleadsid = $staffingleadsid + 1;

        // $staffingleadcheck = ContractStaffingLeads::where('from_user_id', '=', Sentinel::getUser()->id)->where('to_user_id', '=', $id)->first();

        // if ($staffingleadcheck === null) {
        //     $response['leadcheck'] = '0';
        // } else {
        //     if($staffingleadcheck['lead_status'] == '1'){
        //         $response['leadcheck'] = '0';
        //     } else {
        //         $response['leadcheck'] = '1';
        //     }
        // }

        return view('job/resume-details', compact('user','ug_educations','pg_educations','certificates','proexps','projects','employers'));
    }
}
