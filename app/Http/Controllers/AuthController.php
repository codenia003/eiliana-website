<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use App\Http\Requests\ConfirmPasswordRequest;
use App\Providers\RouteServiceProvider;
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
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Country;
use App\Models\TeamUser;
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

    public function getRegister()
    {
        // Show the page
        return view('account/register');
    }

    public function postRegister(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'mobile' => 'required|numeric|min:9',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $response['usersexist'] = '1';
            $response['error'] =  $validator->getMessageBag();
        } else {
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
                $mobile_otp = rand(1000,9999);
                // $mobile_otp = 1234;
                $id = DB::table('user_registration')->insertGetId(
                    ['email' => $request->get('email'), 'mobile' => $request->get('mobile'), 'otp' => $otp, 'mobile_otp' => $mobile_otp]
                );
                $data['otp'] = $otp;

                $to = "91".$request->get('mobile');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.kaleyra.io/v1/HXAP1693485091IN/messages');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'to='.$to.'&type=OTP&sender=ILIANA&body='.$mobile_otp.' is your OTP form eiliana.com&template_id=1007161952340738755');

                $headers = array();
                $headers[] = 'Api-Key: A1ffb94833d64ffd5d5a68e99318b0b25';
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $json_response = curl_exec($ch);

                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                // if ( $status != 201 ) {
                //     die("response $json_response, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
                // }
                curl_close($ch);

                Mail::send('emails.emailTemplates.otp', $data, function ($m) use ($data) {
                    $m->from('info@eiliana.com', 'Eiliana OTP');
                    $m->to($data['email'], 'Eiliana')->subject('OTP for Eiliana');
                });

                $response['email'] = $this->obfuscate_email($request->get('email'));
                $response['mobile_number'] = str_repeat("X", (strlen($request->get('mobile')) - 4)).substr($request->get('mobile'),-4,4);
                $response['reg_id'] = $id;
                $response['usersexist'] = '0';
            }
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

    public function getregisterotp()
    {
        // Show the page
        return view('account/registerotp');
    }

    public function postregisterotp(Request $request)
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

    public function getregisterbasic()
    {
        $roles = Sentinel::getRoleRepository()->all();
        $countries = Country::all();
        // Show the page
        return view('account/registerbasic', compact('roles', 'countries'));
    }

     /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postregisterbasic(UserRequest $request)
    {
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
                'register_as' => $request->get('register_as'),
                'email' => $registration_data->email,
                'mobile' => $registration_data->mobile,
                'dob' => $request->get('dob'),
                'password' => $request->get('password'),
                'govtID' => $request->get('govtID'),
                'idProofNo' => $request->get('idProofNo'),
                'gst_number' => $request->get('gst_number'),
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

            $invitation = $request->session()->get('teaminvitation');
            if($invitation === null){
                $compnay_id = 0;
            } else {
                $compnay_id = $invitation['from_user_id'];

                $teamuser = new TeamUser();
                $teamuser->compnay_id = $compnay_id;
                $teamuser->user_id = $user->id;
                $teamuser->save();

                $request->session()->forget('teaminvitation');

            }

            // Redirect to the home page with success menu
            $response['success'] = '1';
            $response['message'] = trans('auth/message.signup.success');

        } catch (UserExistsException $e) {
            $response['success'] = '0';
            $response['errors'] = trans('auth/message.account_already_exists');
        }

        return response()->json($response);
    }

    public function getloginfirst()
    {
        // Show the page
        return view('account/loginfirst');
    }

    public function postloginfirst(Request $request)
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


            if($user->register_as == '3') {
                $response['success'] = '3';
            } else {
                $response['success'] = '1';
                $user['login_as'] = $user->register_as;
            }

            $role_users = DB::table('role_users')->where('user_id', $user->id)->first();
            $user['role'] = $role_users->role_id;

            $country_name = DB::table('countries')->where('id', $user->country)->first();
            $user['country_name'] = $country_name->name;

            $response['user'] = $user;
            $request->session()->put('users', $user);
            $response['errors'] = trans('auth/message.signin.success');

        } else {
            $response['errors'] = trans('auth/message.account_not_found');
        }

        return response()->json($response);
    }

    public function getLogin()
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return Redirect::route('profile');
        }

        $urlPrevious = url()->previous();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if(($urlPrevious != $urlBase . '/account/login') && ($urlPrevious != $urlBase . '/logout') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }

        // Show the login page
        return view('account/login');
    }

    public function postLogin(Request $request)
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

                    if($user->register_as == '3') {
                        $response['success'] = '3';
                    } else {
                        $response['success'] = '2';
                        $user['login_as'] = $user->register_as;
                    }

                    $role_users = DB::table('role_users')->where('user_id', $user->id)->first();

                    $user['role'] = $role_users->role_id;
                    $country_name = DB::table('countries')->where('id', $user->country)->first();

                    $user['country_name'] = $country_name->name;

                    if(session()->has('url.intended')) {
                        $response['url'] = $request->session()->get('url.intended');
                    } else {
                        $response['url'] = url()->to('/home');
                    }

                    $response['user'] = $user;
                    $response['errors'] = trans('auth/message.signin.success');
                    $request->session()->put('users', $user);

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

    public function fetchCountry()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function getLoginAs()
    {
        return view('account/loginas');
    }

    public function postLoginAs(Request $request)
    {
        $user = $request->session()->get('users');
        $user['login_as'] = $request->input('login_as');
        $request->session()->put('users', $user);

        if(session()->has('url.intended')) {
            $url = $request->session()->get('url.intended');
            return redirect($url)->with('success', 'Login successfully');
        } else {
            return redirect('home')->with('success', 'Login successfully');
        }

    }

}
