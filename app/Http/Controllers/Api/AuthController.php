<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\JoshController;
use App\Http\Requests\ConfirmPasswordRequest;
use App\Mail\Register;
use App\Mail\Welcome;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
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
use App\Models\Country;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ForgotRequest;
use stdClass;
use App\Mail\ForgotPassword;

class AuthController extends JoshController
{
    /**
     * Account sign in.
     *
     * @return View
     */

    private $user_activation = true;

    public function roles()
    {
        $roles = Sentinel::getRoleRepository()->all();

        return response()->json($roles);
    }

    public function checkUserExists(Request $request)
    {
        $data = $request->all();
        $usersemail = User::where('email', $request->get('email'))->first();
        $usersmobile = User::where('mobile', $request->get('mobile'))->first();                    
        if($usersemail){
            $response['usersexist'] = '1';
            $response['error'] = 'Email id already exists';
        } elseif ($usersmobile) {
            $response['usersexist'] = '2';
            $response['error'] = 'Mobile Number already exists';
        } else {
            $otp = rand(1000,9999);
            // $mobile_otp = rand(1000,9999);
            $mobile_otp = 1234;
            $id = DB::table('user_registration')->insertGetId(
                ['email' => $request->get('email'), 'mobile' => $request->get('mobile'), 'otp' => $otp, 'mobile_otp' => $mobile_otp]
            );
            $data['otp'] = $otp;
            /*Mail::send('emails.emailTemplates.otp', $data, function ($m) use ($data) {
                $m->from('info@ciliana.com', 'Eiliana App');
                $m->to($data['email'], 'Eiliana')->subject('OTP for Eiliana');
            });*/

            $response['email'] = $this->obfuscate_email($request->get('email'));
            $response['mobile_number'] = str_repeat("X", (strlen($request->get('mobile')) - 4)).substr($request->get('mobile'),-4,4);
            $response['reg_id'] = $id;
            $response['usersexist'] = '0';
        }

        return response()->json($response);

    }


    public function obfuscate_email($email)
    {
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('X', $len) . "@" . end($em);   
    }

    public function verifyotp(Request $request)
    {
        $data = $request->all();
        $otp = $data['otp'];
        $otpm = $data['otpm'];
        
        $otp_data = DB::table('user_registration')->where('id', '=', $data['reg_id'])->first();
        $otpkdop = $otp_data->otp;
        $mobile_otp = $otp_data->mobile_otp;

        if ($otp == $otpkdop && $otpm == $mobile_otp) {
            $response['success'] = '1';
            $response['reg_id'] = $otp_data->id;
            $updateotp = DB::table('user_registration')->where('id', $data['reg_id'])
                        ->update([
                           'email_verify'  => '1',
                           'mobile_verify' => '1'
                        ]);
        } else {
            $response['success'] = '0';
            $response['errors'] = 'Your Otp Mismatch';
        }
        return response()->json($response); 
    }

     /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postSignup(UserRequest $request)
    {
        // die('dbjb');
        $activate = $this->user_activation;
        $data = $request->all();
        try {

            // $address_image_parts = explode(";base64,", $data['fileData']);
            // $address_image_type_aux = explode("image/", $address_image_parts[0]);
            // $address_image_type = $address_image_type_aux[1];
            // $address_image_base64 = $address_image_parts[1];
            // $address_file = base64_decode($address_image_base64);
            // $address_filename = str_random(10).'.'.$address_image_type;
            // $address_path = $_SERVER['DOCUMENT_ROOT'].'/uploads/users/'.$address_filename;
            // file_put_contents($address_path, $address_file);
            // $fileData = '/uploads/users/' . $address_filename;

            $registration_data = DB::table('user_registration')->where('id', '=', $data['registration_id'])->first();
            // Register the user
            $user = Sentinel::register(
                ([
                'title' => $request->get('title'),
                'first_name' => $request->get('first_name'),
                'middle_name' => $request->get('middle_name'),
                'last_name' => $request->get('last_name'),
                'username' => $request->get('username'),
                'company_name' => $request->get('company_name'),
                'email' => $registration_data->email,
                'mobile' => $registration_data->mobile,
                'dob' => $request->get('dob'),
                'password' => $request->get('password'),
                'govtID' => $request->get('govtID'),
                'idProofNo' => $request->get('idProofNo'),
                'registration_id' => $request->get('registration_id'),
                'anonymous' => $request->get('anonymous'),
                'pseudoName' => $request->get('pseudoName'),
                'country' => $request->get('country'),
                ]), $activate
            );
            // login user automatically
            $role = Sentinel::findRoleById($data['applyas']);
            //add user to 'User' role
            $role->users()->attach($user);

            // Send the activation code through email
            Mail::to($user->email)
                ->send(new Register($data));

            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('Registered');
            
            // Redirect to the home page with success menu
            $response['success'] = '1';
            $response['message'] = trans('auth/message.signup.success');

        } catch (UserExistsException $e) {
            $response['success'] = '0';
            $response['errors'] = trans('auth/message.account_already_exists');
        }

        return response()->json($response);
    }

    public function postSignin(Request $request)
    {
        $response['success'] = '0';
        try {
            // Try to log the user in
             if ($user=  Sentinel::authenticate($request->only('email', 'password'), $request->get('remember-me', 0))) {
                // Redirect to the dashboard page
                //Activity log
                if ($user->first_time == '0') {
                    $response['success'] = '1';
                    $response['id'] = $user->id;
                    $response['errors'] = trans('Please change your password');
                } else {
                    activity($user->full_name)
                    ->performedOn($user)
                    ->causedBy($user)
                    ->log('LoggedIn');
                    $response['success'] = '2';
                    $role_users = DB::table('role_users')->where('user_id', $user->id)->first();
                    $user['role'] = $role_users->role_id;
                    $country_name = DB::table('countries')->where('id', $user->country)->first();
                    $user['country_name'] = $country_name->name;
                    $response['user'] = $user;
                    $response['errors'] = trans('auth/message.signin.success');
                }   
            } else {
                $response['errors'] = trans('auth/message.account_not_found');
            }
        } catch (NotActivatedException $e) {
             $response['errors'] = trans('auth/message.account_not_activated');
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $response['delay'] = $delay;
            $response['errors'] = trans('auth/message.account_suspended');
        }

        return response()->json($response);
    }

    public function postSignfirst(Request $request)
    {   
        $data = $request->all();
        $response['success'] = '0';
        $user = Sentinel::findById($data['user_id']);
        if ($user) {
            Sentinel::update($user, array('password' => $data['password'], 'first_time' =>'1'));
            
            $data=[
                    'user_name' => $user->first_name .' '. $user->last_name,
                ];
            // welcome email
            Mail::to($user->email)
                ->send(new Welcome($data));

            activity($user->full_name)
                    ->performedOn($user)
                    ->causedBy($user)
                    ->log('LoggedIn');
            
            $role_users = DB::table('role_users')->where('user_id', $user->id)->first();
            $user['role'] = $role_users->role_id;

            $country_name = DB::table('countries')->where('id', $user->country)->first();
            $user['country_name'] = $country_name->name;

            $response['user'] = $user;
            $response['success'] = '1';
            $response['errors'] = trans('auth/message.signin.success');
        
        } else {
            $response['errors'] = trans('auth/message.account_not_found');
        }

        return response()->json($response);
    }
   
    /**
     * User account activation page.
     *
     * @param  number $userId
     * @param  string $activationCode
     * @return
     */
    public function getActivate($userId, $activationCode = null)
    {
        // Is user logged in?
        if (Sentinel::check()) {
            return Redirect::route('admin.dashboard');
        }

        $user = Sentinel::findById($userId);
        $activation = Activation::create($user);

        if (Activation::complete($user, $activation->code)) {
            // Activation was successful
            // Redirect to the login page
            return Redirect::route('signin')->with('success', trans('auth/message.activate.success'));
        } else {
            // Activation not found or not completed.
            $error = trans('auth/message.activate.error');
            return Redirect::route('signin')->with('error', $error);
        }
    }

    /**
     * Forgot password form processing page.
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function postForgotPassword(ForgotRequest $request)
    {
        $data = new stdClass();

        try {
            // Get the user password recovery code
            $user = Sentinel::findByCredentials(['email' => $request->get('email')]);

            if (!$user) {
                return back()->with('error', trans('auth/message.account_email_not_found'));
            }
            $activation = Activation::completed($user);
            if (!$activation) {
                return back()->with('error', trans('auth/message.account_not_activated'));
            }
            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Data to be used on the email view

            $data->user_name = $user->first_name .' ' .$user->last_name;
            $data->forgotPasswordUrl = URL::route('forgot-password-confirm', [$user->id, $reminder->code]);

            // Send the activation code through email

            Mail::to($user->email)
                ->send(new ForgotPassword($data));
        } catch (UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return back()->with('success', trans('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param  number $userId
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($userId, $passwordResetCode = null)
    {
        // Find the user using the password reset code
        if (!$user = Sentinel::findById($userId)) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', trans('auth/message.account_not_found'));
        }
        if ($reminder = Reminder::exists($user)) {
            if ($passwordResetCode == $reminder->code) {
                return view('admin.auth.forgot-password-confirm');
            } else {
                return 'code does not match';
            }
        } else {
            return 'does not exists';
        }

        // Show the page
        // return View('admin.auth.forgot-password-confirm');
    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param  Request $request
     * @param  number  $userId
     * @param  string  $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm(ConfirmPasswordRequest $request, $userId, $passwordResetCode = null)
    {

        // Find the user using the password reset code
        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. something went wrong
            return Redirect::route('signin')->with('error', trans('auth/message.forgot-password-confirm.error'));
        }

        // Password successfully reseted
        return Redirect::route('signin')->with('success', trans('auth/message.forgot-password-confirm.success'));
    }

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {

        if (Sentinel::check()) {
            //Activity log
            $user = Sentinel::getuser();
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('LoggedOut');
            // Log the user out
            Sentinel::logout();
        }


        // Redirect to the users page
        return redirect('admin/signin')->with('success', 'You have successfully logged out!');
    }

    public function fetchCountry() {
        $countries = Country::all();
        return response()->json($countries);
    }

}
