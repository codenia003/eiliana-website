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
use Session;
use URL;
use Validator;
use View;
use DB;
use App\Models\User;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Qualification;
use App\Models\EducationType;
use App\Models\University;
use App\Models\Country;
use App\Models\ProfessionalExperience;
use App\Models\UserProject;
use App\Models\ProjectCategory;
use App\Models\ProjectType;
use App\Models\Employers;
use App\Models\Designation;
use App\Models\EmployerDetails;
use App\Models\EmployerType;
use App\Models\Technology;
use App\Models\Location;
use App\Models\CustomerIndustry;
use stdClass;

class ProfileController extends JoshController
{
    /**
     * Profile.
     *
     * @return View
     */
    public function __construct() {

    }


    public function basicInfo()
    {
        $user = Sentinel::getUser();
        $countries = Country::where('id', $user->country)->get();

        // print_r(Sentinel::getRoleRepository());
        // die();

        return view('profile/basic-info', compact('user', 'countries'));
    }


    public function addtionalInfo()
    {
        // Show the page
        return view('profile/addtional-info');
    }


    public function education()
    {
        $educationtype = EducationType::all();
        $qualifications = Qualification::all();
        $universities = University::orderBy('name', 'asc')->get();
        $user = Sentinel::getUser();
        $ug_educations = Education::where('user_id', $user->id)->where('graduation_type', '3')->get();
        $pg_educations = Education::where('user_id', $user->id)->where('graduation_type', '4')->get();
        // Show the page
        // return view('profile/education');
        return view('profile/education-add', compact('ug_educations','pg_educations','educationtype','qualifications','universities'));
    }


    public function certification()
    {
        $user = Sentinel::getUser();
        $certificates = Certificate::where('user_id', $user->id)->get();

        // Show the page
        return view('profile/certification-add', compact('certificates'));
    }

    public function professionalExperience()
    {
        $user = Sentinel::getUser();
        //$projectcategorys = ProjectCategory::all();
        $proexps = ProfessionalExperience::where('user_id', $user->id)->get();
        $technologies = Technology::where('parent_id', '0')->get();
        $locations = Location::all();
        $projectcategorys = ProjectCategory::where('parent_id', '0')->get();

        if (count($proexps) > 0) {
            $model_engagement_new = (array) json_decode($proexps[0]['model_engagement'],true);
            $selected_technologies = explode(",", $proexps[0]['technologty_pre']);
            $selected_framework = explode(",", $proexps[0]['framework']);
            //$selected_project_category = $proexps[0]['project_category'];
            //$dd =
            $childtechnologies = Technology::whereIn('parent_id', $selected_technologies)->get();
            //$childproject_sub_category = ProjectCategory::whereIn('parent_id', $selected_project_category)->get();
        } else {
            $model_engagement_new = [];
            $selected_technologies = [];
            $selected_framework = [];
            $childtechnologies = [];
            //$childproject_sub_category = [];
        }
        //$designations = Designation::all();
        // print_r($childtechnologies);
        return view('profile/prof-exp', compact('proexps','model_engagement_new','projectcategorys','technologies','selected_technologies','childtechnologies','selected_framework','locations'));
    }

    public function getframework(Request $request)
    {
        $alldata = $request->input('technologty_pre');
        $selected_technologies = explode(",", $alldata);
        $technologies = Technology::whereIn('parent_id', $selected_technologies)->get();
        return response()->json($technologies);
    }

    public function projects()
    {

        $projects = UserProject::where('user_id', Sentinel::getUser()->id)->get();
        $employers = Employers::where('user_id', Sentinel::getUser()->id)->get();
        $technologies = Technology::where('parent_id', '0')->get();
        $frameworks = Technology::where('parent_id', '!=', '0')->get();
        $projecttypes = ProjectType::all();
        $customerindustries = CustomerIndustry::all();

        return view('profile/projects', compact('projects','employers','technologies', 'frameworks','projecttypes','customerindustries'));
    }

    public function employer()
    {
        $user = Sentinel::getUser();
        $designations = Designation::all();
        $employertype = EmployerType::all();
        $employers = Employers::where('user_id', $user->id)->get();
        $employerdetails = EmployerDetails::where('user_id', $user->id)->get();
        return view('profile/employer', compact('employers','designations','employerdetails','employertype'));
    }

    public function financial()
    {
        return view('profile/financial');
    }

    public function fetchEducationType() {
        $educationtype = DB::table('education_type')->get();
        return response()->json($educationtype);
    }

    public function publicAnonymusUpdate(Request $request)
    {
        $users = Sentinel::getUser();
        Sentinel::update($users, array('anonymous' => $request->input('anonymous')));

        return response()->json($users);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $input = $request->except('_token');
        $response['success'] = '0';
        $user = Sentinel::getUser();
        $id = $user->id;

        $resume = User::find($id);
        $resume->anonymous = $input['anonymous'];
        if($resume->anonymous == 1)
        {
            $resume->pseudoName = $input['pseudoName'];
        }

        $resume->first_name = $input['first_name'];
        $resume->last_name = $input['last_name'];
        $resume->dob = $input['dob'];
        $resume->country = $input['country'];
        $resume->interested = $input['interested'];
        
        if(isset(Session::get('teaminvitation')['to_user'])){
            $resume->experience = $input['experience'];
            $resume->key_skills = $input['key_skills'];
        }

        $safeName = "";

        if ($request->hasFile('resume_file')) {
            $file = $request->file('resume_file');
            $extension = $file->extension()?: 'png';
            $safeName = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/resumes/';
            $file->move($destinationPath, $safeName);
            $resume->resume_file = $safeName;
        }

        // if (isset($input['resume_file'])) {
        //     $file = $input['resume_file'];
        //     $extension = $file->extension();
        //     $folderName = '/uploads/resumes';
        //     $destinationPath = public_path() . $folderName;
        //     $safeName = str_random(10) . '.' . $extension;
        //     $file->move($destinationPath, $safeName);
        //     $resume->resume_file = '/uploads/resumes/'.$safeName;
        // }

        //$resume_data = $resume->save();
        //$user->update($request->except('user_id'));

        // Was the user updated?
        if($resume->save()) {
            // Prepare the success message
            $success = trans('users/message.success.update');
            //Activity log for update account
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User Updated successfully');
            // Redirect to the user page
            $response['user'] = $user;
            $response['success'] = '1';
            $response['errors'] = $success;
        }

        // Prepare the error message
        $error = trans('users/message.error.update');
        $response['errors'] = $error ;

        return response()->json($response);
    }

    public function registerEducation(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        foreach ($input['education_id'] as $key => $value) {
            if(!empty($input['education_type'][$key])){
                if ($input['education_id'][$key] != 0) {
                    $education = Education::find($input['education_id'][$key]);
                    $education->user_id = $user->id;
                    $education->education_type = $input['education_type'][$key];
                    $education->graduation_type = $input['graduation_type'][$key];
                    $education->name = $input['name'][$key];
                    $education->month = $input['month'][$key];
                    $education->year = $input['year'][$key];
                    $education->degree = $input['degree'][$key];
                    $education->save();
                } else {
                    $education = new Education;
                    $education->user_id = $user->id;
                    $education->education_type = $input['education_type'][$key];
                    $education->graduation_type = $input['graduation_type'][$key];
                    $education->name = $input['name'][$key];
                    $education->month = $input['month'][$key];
                    $education->year = $input['year'][$key];
                    $education->degree = $input['degree'][$key];
                    $education->save();
                }
            }
        }
        return redirect('profile/certification')->with('success', 'Education updated successfully');
    }

    public function deleteEducation(Request $request)
    {
        $education = Education::find($request->input('edu_id'));
        $education->delete();

        $response['success'] = '1';
        return response()->json($response);
    }

    public function registerCertification(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        foreach ($input['certificate_id'] as $key => $value) {

            if ($input['certificate_id'][$key] != 0) {
                $certificate = Certificate::find($input['certificate_id'][$key]);
                $certificate->user_id = $user->id;
                $certificate->certificate_no = $input['certificate_no'][$key];
                $certificate->name = $input['name'][$key];
                $certificate->from_date = $input['from_date'][$key];
                $certificate->till_date = $input['till_date'][$key];
                $certificate->institutename = $input['institutename'][$key];
                $certificate->display_status = 1;
                $certificate->save();
            } else {
                $certificate = new Certificate;
                $certificate->user_id = $user->id;
                $certificate->certificate_no = $input['certificate_no'][$key];
                $certificate->name = $input['name'][$key];
                $certificate->from_date = $input['from_date'][$key];
                $certificate->till_date = $input['till_date'][$key];
                $certificate->institutename = $input['institutename'][$key];
                $certificate->display_status = 1;
                $certificate->save();
            }
        }

        return redirect('profile/professional-experience')->with('success', 'Certificate updated successfully');
    }

    public function deleteCertification(Request $request)
    {
        $certificate = Certificate::find($request->input('cert_id'));
        $certificate->delete();

        $response['success'] = '1';
        return response()->json($response);
    }

    public function resgiterProfessionalExperience(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->interested == "2"){
            $request->validate([
                'key_skills' => 'required',
                'technologty_pre' => 'required',
            ]);
        } else {
            $request->validate([
                'model_engagement' => 'required',
                'technologty_pre' => 'required',
            ]);
        }



        $input = $request->except('_token');
        $input['user_id'] = $user->id;

        $indexing = "";
        if($input['key_skills'] != null) {
            $words = explode(" " ,$input['key_skills']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }
        if($input['profile_headline'] != null)
        {
            $words=explode(" " ,$input['profile_headline']);
            foreach($words as $word) {
                $indexing .= metaphone($word). " ";
            }
        }

        $technologty_pre = $request->input('technologty_pre');
        $technologty_pre = implode(',', $technologty_pre);
        $input['technologty_pre'] = $technologty_pre;

        $framework = $request->input('framework');
        $framework = implode(',', $framework);
        $input['framework'] = $framework;

        if (!empty($input['professional_experience_id'])) {

            $professionalExperience = ProfessionalExperience::find($input['professional_experience_id']);
            $professionalExperience->user_id = $user->id;
            // $professionalExperience->video_url = $input['video_url'];
            $professionalExperience->key_skills = $input['key_skills'];
            $professionalExperience->profile_headline = $input['profile_headline'];
            $professionalExperience->project_category = $input['project_category'];
            $professionalExperience->technologty_pre = $input['technologty_pre'];
            $professionalExperience->framework = $input['framework'];
            $professionalExperience->model_engagement = $input['model_engagement'];
            $professionalExperience->experience_year = $input['experience_year'];
            $professionalExperience->experience_month = $input['experience_month'];
            $professionalExperience->support_project = $input['support_project'];
            //$professionalExperience->designation = $input['designation'];
            if(!empty($input['project_sub_category']))
            {
                $professionalExperience->project_sub_category = $input['project_sub_category'];
            }
            $professionalExperience->current_location = $input['current_location'];
            $professionalExperience->preferred_location = $input['preferred_location'];
            $professionalExperience->development_project = $input['development_project'];
            $professionalExperience->indexing = $indexing;
            $professionalExperience->save();

        } else {
            $input['indexing'] = $indexing;
            ProfessionalExperience::create($input);
        }

        if ($user->interested == "2") {
            return redirect('profile/employer')->with('success', 'Professional Experience updated successfully');
        } else {
            return redirect('profile/projects')->with('success', 'Professional Experience updated successfully');
        }
    }

    public function registerProjects(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        foreach ($input['user_project_id'] as $key => $value) {

            if ($input['user_project_id'][$key] != 0) {
                $userproject = UserProject::find($input['user_project_id'][$key]);
                $userproject->user_id = $user->id;
                $userproject->project_name = $input['project_name'][$key];
                $userproject->project_type = $input['project_type'][$key];
                $userproject->duration = $input['duration'][$key];
                $userproject->technologty_pre = $input['technologty_pre'][$key];
                $userproject->framework = $input['framework'][$key];
                $userproject->version = '1';
                $userproject->industry = $input['industry'][$key];
                $userproject->project_details = $input['project_details'][$key];
                $userproject->employer_id = $input['employer_id'][$key];
                $userproject->display_status = 1;

                if (isset($input['upload_file'][$key])) {
                    $file = $input['upload_file'][$key];
                    $extension = $file->extension();
                    $folderName = '/uploads/projects/';
                    $destinationPath = public_path() . $folderName;
                    $safeName = str_random(10) . '.' . $extension;
                    $file->move($destinationPath, $safeName);
                    //save new file path into db
                    $userproject->upload_file = '/uploads/projects/'.$safeName;
                }

                $userproject->save();

            } else {
                $userproject = new UserProject;
                $userproject->user_id = $user->id;
                $userproject->project_name = $input['project_name'][$key];
                $userproject->project_type = $input['project_type'][$key];
                $userproject->duration = $input['duration'][$key];
                $userproject->technologty_pre = $input['technologty_pre'][$key];
                $userproject->framework = $input['framework'][$key];
                $userproject->version = '1';
                $userproject->industry = $input['industry'][$key];
                $userproject->project_details = $input['project_details'][$key];
                $userproject->employer_id = $input['employer_id'][$key];
                $userproject->display_status = 1;

                if (isset($input['upload_file'][$key])) {
                    $file =  $input['upload_file'][$key];
                    $extension = $file->extension()?: 'png';
                    $folderName = '/uploads/projects/';
                    $destinationPath = public_path() . $folderName;
                    $safeName = str_random(10) . '.' . $extension;
                    $file->move($destinationPath, $safeName);

                    //save new file path into db
                    $userproject->upload_file =url('/').'/uploads/projects/'.$safeName;
                }

                $userproject->save();
            }
        }

        // return redirect('profile/professional-experience')->with('success', 'Project updated successfully');
        return redirect('welcome')->with('success', 'Project updated successfully');
    }

    public function deleteProjects(Request $request)
    {
        $userproject = UserProject::find($request->input('project_id'));
        $userproject->delete();

        $response['success'] = '1';
        return response()->json($response);
    }

    public function registeremployer(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');
        if ($input['employer_details_id'] != 0) {
            $employerdetails = EmployerDetails::find($input['employer_details_id']);
            $employerdetails->user_id = $user->id;
            //$employerdetails->current = $input['current'];
            $employerdetails->current_salary_lacs = $input['current_salary_lacs'];
            $employerdetails->current_salary_thousand = $input['current_salary_thousand'];
            $employerdetails->expected_salary_lacs = $input['expected_salary_lacs'];
            $employerdetails->expected_salary_thousand = $input['expected_salary_thousand'];
            $employerdetails->notice_period = $input['notice_period'];
            $employerdetails->notice_period = $input['notice_period'];
            $employerdetails->display_status = 1;
            $employerdetails->save();
        } else {
            $employerdetails = new EmployerDetails;
            $employerdetails->user_id = $user->id;
            //$employerdetails->current = $input['current'];
            $employerdetails->current_salary_lacs = $input['current_salary_lacs'];
            $employerdetails->current_salary_thousand = $input['current_salary_thousand'];
            $employerdetails->expected_salary_lacs = $input['expected_salary_lacs'];
            $employerdetails->expected_salary_thousand = $input['expected_salary_thousand'];
            $employerdetails->notice_period = $input['notice_period'];
            $employerdetails->notice_period = $input['notice_period'];
            $employerdetails->display_status = 1;
            $employerdetails->save();
        }
        foreach ($input['employer_id'] as $key => $value) {

            if ($input['employer_id'][$key] != 0) {
                $employer = Employers::find($input['employer_id'][$key]);
                $employer->user_id = $user->id;
                $employer->current = $input['current'][$key];
                $employer->employer_name = $input['employer_name'][$key];
                $employer->designation = $input['designation'][$key];
                $employer->duration_year = $input['duration_year'][$key];
                $employer->duration_month = $input['duration_month'][$key];
                $employer->employment_type = $input['employment_type'][$key];
                $employer->job_profile = $input['job_profile'][$key];
                $employer->notice_period = $input['notice_period'][$key];
                $employer->display_status = 1;
                $employer->save();
            } else {
                $employer = new Employers;
                $employer->user_id = $user->id;
                $employer->current = $input['current'][$key];
                $employer->employer_name = $input['employer_name'][$key];
                $employer->designation = $input['designation'][$key];
                $employer->duration_year = $input['duration_year'][$key];
                $employer->duration_month = $input['duration_month'][$key];
                $employer->employment_type = $input['employment_type'][$key];
                $employer->job_profile = $input['job_profile'][$key];
                $employer->notice_period = $input['notice_period'][$key];
                $employer->display_status = 1;
                $employer->save();
            }
        }

        return redirect('profile/projects')->with('success', 'Employer updated successfully');
    }

    public function deleteemployer(Request $request)
    {
        $employer = Employers::find($request->input('emp_id'));
        $employer->delete();

        $response['success'] = '1';
        return response()->json($response);
    }


    public function uploadProfilePic(Request $request)
    {
        $data = $request->all();
        $user = Sentinel::getUser();

        if ($file = $request->file('pic')) {
            $extension = $file->extension()?: 'png';
            $folderName = '/uploads/users/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //save new file path into db
            $user->pic = '/uploads/users/'.$safeName;
        }

        // Was the user updated?
        if ($user->save()) {
            // Prepare the success message
            $success = 'Profile Pic Updated successfully';
            //Activity log for update account
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('Profile Pic Updated successfully');
        }

        return redirect('/profile')->with('success', 'Profile Pic Updated successfully');

    }

    public function updateProfileResume(Request $request)
    {
        $data = $request->all();
        $input = $request->except('_token');
        $response['success'] = '0';
        $user = Sentinel::getUser();

        $safeName = "";

        if ($request->hasFile('resume_file')) {
            $file = $request->file('resume_file');
            $extension = $file->extension()?: 'png';
            $safeName = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/resumes/';
            $file->move($destinationPath, $safeName);
            $user->resume_file = $safeName;
        }

        // Was the user updated?
        if($user->save()) {
            // Prepare the success message
            $success = trans('users/message.success.update');
            //Activity log for update account
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User Updated successfully');
            // Redirect to the user page
            // $response['user'] = $user;
            // $response['success'] = '1';
            // $response['errors'] = $success;
        }

        // Prepare the error message
        return redirect('/home')->with('success', 'Resume updated successfully');
    }

}
