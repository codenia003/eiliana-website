<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\UserRequest;
use App\Mail\Register;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Sentinel;
use URL;
use View;
use Yajra\DataTables\DataTables;
use Validator;
use App\Mail\Restore;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Country;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\ProfessionalExperience;
use App\Models\UserProject;
use App\Models\Employers;
use App\Models\Technology;
use App\Models\Location;
use App\Models\Designation;
use App\Models\EmployerDetails;
use App\Models\Qualification;
use App\Models\University;
use App\Models\EducationType;
use App\Models\ProjectCategory;
use App\Models\CustomerIndustry;
use App\Models\ProjectType;
use App\Models\EmployerType;
use App\Models\TeamUser;

class UsersController extends JoshController
{

    /**
     * Show a list of all the users.
     *
     * @return View
     */
    private $user_activation = false;
    protected $countries;

    public function __construct()
    {
        $this->countries = Country::all()->pluck('name', 'sortname')->toArray();
    }


    public function index()
    {
        $users = User::get(['id', 'first_name', 'last_name', 'email','created_at','mobile']);
        // Show the page
        return view('admin.users.index', compact('users'));
    }

    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
    public function data()
    {
        $users = User::get(['id', 'first_name', 'last_name', 'email','created_at','mobile']);

        return DataTables::of($users)
            ->editColumn(
                'created_at',
                function (User $user) {
                    return $user->created_at->diffForHumans();
                }
            )
            ->addColumn(
                'status',
                function ($user) {

                    if ($activation = Activation::completed($user)) {
                        return 'Activated';
                    } else {
                                        return 'Pending';
                    }
                }
            )
            ->addColumn(
                'actions',
                function ($user) {

                    $actions = '
                            <a href='. route('admin.users.edit', $user->id) .'><i class="livicon d-none" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';
                    if ((Sentinel::getUser()->id != $user->id) && ($user->id >1)) {
                        $actions .= '<a href='. route('admin.users.show', $user->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('admin.users.confirm-delete', $user->id) .' data-id="'.$user->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon " data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                    }
                    return $actions;
                }
            )
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
        // Get all the available roles
        $roles = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.users.create', compact('roles', 'countries'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(UserRequest $request)
    {
        //upload image
        if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/users/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic'] =url('/').'/uploads/users/'.$safeName;
        }
        //check whether use should be activated by default or not
        $activate = $request->get('activate') ? true : false;

        try {
            // Register the user
            $user = Sentinel::register($request->except('_token', 'password_confirm', 'role', 'activate', 'pic_file', 'g-recaptcha-response'), $activate);

            //add user to 'User' role
            $role = Sentinel::findRoleById($request->get('role'));
            if ($role) {
                $role->users()->attach($user);
            }
            //check for activation and send activation mail if not activated by default
            if (!$request->get('activate')) {
                // Data to be used on the email view
                $data =[
                    'user_name' => $user->first_name .' '. $user->last_name,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code])
                ];
                // Send the activation code through email
                Mail::to($user->email)
                    ->send(new Register($data));
            }
            // Activity log for New user create
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('New User Created by '.Sentinel::getUser()->full_name);
            // Redirect to the home page with success menu
            return Redirect::route('admin.users.index')->with('success', trans('users/message.success.create'));
        } catch (LoginRequiredException $e) {
            $error = trans('admin/users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = trans('admin/users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = trans('admin/users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit(User $user)
    {

        // Get this user roles
        $userRoles = $user->getRoles()->pluck('name', 'id')->all();
        // Get a list of all the available roles
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($user);

        $countries = $this->countries;

        // Show the page
        return view('admin.users.edit', compact('user', 'roles', 'userRoles', 'countries', 'status'));
    }

    /**
     * User update form processing page.
     *
     * @param  User        $user
     * @param  UserRequest $request
     * @return Redirect
     */
    public function update(User $user, UserRequest $request)
    {


        try {
            $user->update($request->except('pic_file', 'password', 'password_confirm', 'roles', 'activate'));

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            // is new image uploaded?
            if ($file = $request->file('pic_file')) {
                $extension = $file->extension()?: 'png';
                $destinationPath = public_path() . '/uploads/users/';
                $safeName = str_random(10) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                //delete old pic if exists
                if (File::exists($destinationPath . $user->pic)) {
                    File::delete($destinationPath . $user->pic);
                }
                //save new file path into db
                $user->pic =url('/').'/uploads/users/'.$safeName;
            }

            //save record
            $user->save();

            // Get the current user roles
            $userRoles = $user->roles()->pluck('id')->all();

            // Get the selected roles

            $selectedRoles = $request->get('roles');

            // Roles comparison between the roles the user currently
            // have and the roles the user wish to have.
            $rolesToAdd = array_diff($selectedRoles, $userRoles);
            $rolesToRemove = array_diff($userRoles, $selectedRoles);

            // Assign the user to roles

            foreach ($rolesToAdd as $roleId) {
                $role = Sentinel::findRoleById($roleId);
                $role->users()->attach($user);
            }

            // Remove the user from roles
            foreach ($rolesToRemove as $roleId) {
                $role = Sentinel::findRoleById($roleId);
                $role->users()->detach($user);
            }

            // Activate / De-activate user

            $status = $activation = Activation::completed($user);

            if ($request->get('activate') != $status) {
                if ($request->get('activate')) {
                    $activation = Activation::exists($user);
                    if ($activation) {
                        Activation::complete($user, $activation->code);
                    }
                } else {
                    //remove existing activation record
                    Activation::remove($user);
                    //add new record
                    Activation::create($user);
                    //send activation mail
                    $data=[
                        'user_name' =>$user->first_name .' '. $user->last_name,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::exists($user)->code])
                    ];
                    // Send the activation code through email
                    Mail::to($user->email)
                        ->send(new Restore($data));
                }
            }

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = trans('users/message.success.update');
                //Activity log for user update
                activity($user->full_name)
                    ->performedOn($user)
                    ->causedBy($user)
                    ->log('User Updated by '.Sentinel::getUser()->full_name);
                // Redirect to the user page
                return Redirect::route('admin.users.edit', $user)->with('success', $success);
            }

            // Prepare the error message
            $error = trans('users/message.error.update');
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }

        // Redirect to the user page
        return Redirect::route('admin.users.edit', $user)->withInput()->with('error', $error);
    }

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedUsers()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_users', compact('users'));
    }


    /**
     * Delete Confirm
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id)
    {
        $model = 'users';
        $confirm_route = $error = null;
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = trans('users/message.error.delete');

                return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.users.delete', ['id' => $user->id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        try {
            // Get user information
            $user = Sentinel::findById($id);
            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = trans('admin/users/message.error.delete');
                // Redirect to the user management page
                return Redirect::route('admin.users.index')->with('error', $error);
            }
            // Delete the user
            //to allow soft deleted, we are performing query on users model instead of Sentinel model
            User::destroy($id);

            Activation::where('user_id', $user->id)->delete();
            Education::where('user_id', $user->id)->delete();
            Certificate::where('user_id', $user->id)->delete();
            ProfessionalExperience::where('user_id', $user->id)->delete();
            UserProject::where('user_id', $user->id)->delete();
            Employers::where('user_id', $user->id)->delete();
            EmployerDetails::where('user_id', $user->id)->delete();
            TeamUser::where('user_id', $user->id)->delete();
            

            // Prepare the success message
            $success = trans('users/message.success.delete');
            //Activity log for user delete
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User deleted by '.Sentinel::getUser()->full_name);
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id)
    {
        try {
            // Get user information
            $user = User::withTrashed()->find($id);
            // Restore the user
            $user->restore();
            // create activation record for user and send mail with activation link
            //            $data->user_name = $user->first_name .' '. $user->last_name;
            //            $data->activationUrl = URL::route('activate', [$user->id, Activation::create($user)->code]);
            // Send the activation code through email
            $data=[
               'user_name' => $user->first_name .' '. $user->last_name,
                'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code])
            ];
            Mail::to($user->email)
                ->send(new Restore($data));
            // Prepare the success message
            $success = trans('users/message.success.restored');
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User restored by '.Sentinel::getUser()->full_name);
            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('error', $error);
        }
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            // Get the user information
            $user = Sentinel::findUserById($id);
            $countries = Country::all();
            $ug_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '3')->get();
            $response['qualifications'] = Qualification::all();
            $response['universities'] = University::orderBy('name', 'asc')->get();
            $response['educationtype'] = EducationType::all();
            $response['locations'] = Location::all();
            $response['customer_industrys'] = CustomerIndustry::all();
            $response['projecttypes'] = ProjectType::all();
            $response['designations'] = Designation::all();
            $response['employertype'] = EmployerType::all();
            $response['technologies'] = Technology::where('parent_id', '0')->get();
            $response['technologies_framework'] = Technology::where('parent_id', '!=', 0)->get();                        
            $pg_educations = Education::with('educationtype', 'university', 'qualification')->where('user_id', $id)->where('graduation_type', '4')->get();
            $certificates = Certificate::where('user_id', $id)->get();
            $proexps = ProfessionalExperience::where('user_id', $id)->first();
            
            if(empty($proexps->technologty_pre)){
                $technologies = [];
                $selected_technologty_pre = [];
                $locations = '';
                $preferred_location = '';
            } else {
                $selected_technologty_pre = explode(',', $proexps->technologty_pre);
                // $selected_framework = explode(',', $proexps->framework);
                $technologies = Technology::whereIn('technology_id', $selected_technologty_pre)->get();
                // $childtechnologies = Technology::whereIn('technology_id', $selected_framework)->get();
                $locations = Location::where('location_id', $proexps->current_location)->first();
                $preferred_location = Location::where('location_id', $proexps->preferred_location)->first();
            }
            
            
            $projects = UserProject::with('projecttypes', 'technologuname', 'frameworkname','customerindustry','employername')->where('user_id', $id)->get();
            $employers = Employers::with('designationtype','employertype')->where('user_id', $id)->get();
            $employer_details = EmployerDetails::where('user_id', $id)->get();
            
                
          
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
        // Show the page
        return view('admin.users.show', compact('user','ug_educations','pg_educations','certificates','proexps','projects','employers','countries','selected_technologty_pre','technologies','locations','preferred_location','employer_details','response'));
    }

    public function getframework(Request $request)
    {

        $alldata = $request->input('technologty_pre');
        $selected_technologies = explode(",", $alldata);
        $technologies = Technology::whereIn('parent_id', $selected_technologies)->get();
        return response()->json($technologies);
    }

    public function passwordreset(Request $request)
    {
        $id = $request->id;
        $user = Sentinel::findUserById($id);
        $password = $request->get('password');
        $user->password = Hash::make($password);
        $user->save();
    }

    public function updateuser_information(Request $request)
    {
        
        $id = $request->id;
        $user = Sentinel::findUserById($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->dob = $request->dob;
        $user->pseudoName = $request->pseudoName;
        $user->country = $request->country;
        $user->save();
    
     // return Redirect::route('admin.users.show', $id);
        $url = "admin/users/".$id;
     return redirect($url)->with('success', 'User Information updated successfully');
    }

    public function updateuser_education(Request $request)
    {
                $input = $request->except('_token');    
                $id  = $request->user_id;   

         foreach ($input['education_id'] as $key => $value) {              
               
                $education = Education::find($input['education_id'][$key]);
                $education->education_type = $input['education_type'][$key];
                $education->name = $input['name'][$key];
                $education->month = $input['month'][$key];
                $education->year = $input['year'][$key];
                $education->degree = $input['degree'][$key];                            
                $education->save();
         }
        
    
       // return Redirect::route('admin.users.show', $id);
         $url = "admin/users/".$id;
     return redirect($url)->with('success', 'Education updated successfully');
    }

   public function updateuser_certificate(Request $request)
    {
                $input = $request->except('_token');  
                $id  = $request->user_id;   
                 
         foreach ($input['certificate_id'] as $key => $value) {              
               
                $certificate = Certificate::find($input['certificate_id'][$key]);
                $certificate->certificate_no = $input['certificate_no'][$key];
                $certificate->name = $input['name'][$key];
                $certificate->from_date = $input['from_date'][$key];
                $certificate->till_date = $input['till_date'][$key];
                $certificate->institutename = $input['institutename'][$key];
                $certificate->save();
         }
        
    
          $url = "admin/users/".$id;
     return redirect($url)->with('success', 'Certificate updated successfully');
    }

    public function updateuser_professionalexp(Request $request)
    {
         $input = $request->except('_token');         
         $id  = $request->user_id;   

        $technologty_pre = $request->input('technologty_pre');
        $technologty_pre = implode(',', $technologty_pre);
        $input['technologty_pre'] = $technologty_pre;

        // $framework = $request->input('framework');
        // $framework = implode(',', $framework);
        // $input['framework'] = $framework;


            $professionalExperience = ProfessionalExperience::find($input['professional_experience_id']);      
            $professionalExperience->key_skills = $input['key_skills'];
            $professionalExperience->profile_headline = $input['profile_headline'];
            $professionalExperience->technologty_pre = $input['technologty_pre'];
            //$professionalExperience->framework = $input['framework'];        
            $professionalExperience->experience_year = $input['experience_year'];
            $professionalExperience->experience_month = $input['experience_month'];
            $professionalExperience->support_project = $input['support_project'];       
            $professionalExperience->current_location = $input['current_location'];
            $professionalExperience->preferred_location = $input['preferred_location'];
            $professionalExperience->development_project = $input['development_project'];
            
            $professionalExperience->save();
    
          $url = "admin/users/".$id;
     return redirect($url)->with('success', 'Professional Experience updated successfully');
    }
    
     public function updateuser_project(Request $request)
    {
               $input = $request->except('_token');
               $id  = $request->user_id;   
                 
         foreach ($input['user_project_id'] as $key => $value) {              
               
                $userproject = UserProject::find($input['user_project_id'][$key]);
                $userproject->project_name = $input['project_name'][$key];
                $userproject->project_type = $input['project_type'][$key];
                $userproject->technologty_pre = $input['technologty_pre'][$key];
                $userproject->framework = $input['framework'][$key];
                $userproject->duration = $input['duration'][$key];
                $userproject->industry = $input['industry'][$key];
                $userproject->project_details = $input['project_details'][$key];
                $userproject->save();
         }
        
               $url = "admin/users/".$id;
     return redirect($url)->with('success', 'Project updated successfully');
    }


     public function updateuser_employer(Request $request)
    {
            $input = $request->except('_token');
            $id  = $request->user_id;  

            $employerdetails = EmployerDetails::find($input['employer_details_id']);           
            $employerdetails->current_salary_lacs = $input['current_salary_lacs'];
            $employerdetails->current_salary_thousand = $input['current_salary_thousand'];
            $employerdetails->expected_salary_lacs = $input['expected_salary_lacs'];
            $employerdetails->expected_salary_thousand = $input['expected_salary_thousand'];
            $employerdetails->notice_period = $input['notice_period'];     
            $employerdetails->save(); 
                 
         foreach ($input['employer_id'] as $key => $value) {              
               
            $employer = Employers::find($input['employer_id'][$key]);
            $employer->employer_name = $input['employer_name'][$key];
            $employer->designation = $input['designation'][$key];
            $employer->duration_year = $input['duration_year'][$key];
            $employer->duration_month = $input['duration_month'][$key];
            $employer->employment_type = $input['employment_type'][$key];
            $employer->job_profile = $input['job_profile'][$key];
            $employer->save();
               
         }
        
    
          $url = "admin/users/".$id;
     return redirect($url)->with('success', 'Employer updated successfully');
    }

    public function import()
    {
        return view('admin/users/import_users');
    }
    public function downloadExcel($type)
    {
        return response()->download(base_path('resources/excel-templates/users.xlsx'));
    }

    public function importInsert(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $activate = $this->user_activation;
            $path = $request->file('import_file')->getRealPath();
            $users = Excel::selectSheets('users')->load(
                $path,
                function ($reader) {
                }
            )->get();
            if (! empty($users) && $users->count()) {
                foreach ($users->toArray() as $key => $row) {
                    $my_data = [
                      'email' => $row['email'],
                       'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                         'password' => $row['password'],
                    ];
                    $validator = Validator::make(
                        $my_data,
                        [
                         'email' => 'email',
                         'first_name' => 'required|min:3',
                         'last_name' => 'required|min:3',
                         'password' => 'required|min:3'
                         ]
                    );
                    if (isset($row['first_name']) && trim($row['first_name']) !="" && !$validator->fails()) {
                        $selected_user = User::where(
                            [
                                ['email' , $row['email']]
                            ]
                        )->first();

                        if ($selected_user) {
                            $user = $selected_user->update(
                                [
                                'email'         => $row['email'],
                                'first_name'         => $row['first_name'],
                                'last_name'            => $row['last_name'],
                                'password'            => Hash::make($row['password']),
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                                ]
                            );

                            activity($selected_user->full_name)
                            ->performedOn($selected_user)
                            ->causedBy($selected_user)
                            ->log('User Updated by '.Sentinel::getUser()->full_name);
                        } else {
                            $user = Sentinel::register(
                                [
                                'email'         => $row['email'],
                                'first_name'         => $row['first_name'],
                                'last_name'            => $row['last_name'],
                                'password'            => Hash::make($row['password']),
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                                ],
                                $activate
                            );

                              activity($user->full_name)
                            ->performedOn($user)
                            ->causedBy($user)
                            ->log('User Registered by '.Sentinel::getUser()->full_name);
                            // login user automatically
                            $role = Sentinel::findRoleById(2);
                            //add user to 'User' role

                            $role->users()->attach($user);
                            if (!$activate) {
                                // Data to be used on the email view

                                $data=[
                                    'user_name' => $user->first_name .' '. $user->last_name,
                                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                                ];
                                // Send the activation code through email
                                Mail::to($user->email)->send(new Register($data));
                            }
                        }
                    }
                }

                return back()->with('success', 'Inserted Record Successfully');
            }
        }
        return back()->with('error', 'Please Check your file, Something is wrong there.');
    }
}
