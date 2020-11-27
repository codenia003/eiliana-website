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
use App\Models\Certificate;
use App\Models\Country;
use stdClass;

class ProfileController extends JoshController
{
    /**
     * Profile.
     *
     * @return View
     */


    public function basicInfo()
    {
        $user = Sentinel::getUser();
        $countries = Country::all();

        return view('profile/basic-info', compact('user', 'countries'));
    }


    public function addtionalInfo()
    {
        // Show the page
        return view('profile/addtional-info');
    }


    public function education()
    {
        $user = Sentinel::getUser();
        $educations = Education::where('user_id', $user->id)->with('educationtype')->get();
        // print_r($educations);
        // die();
        // Show the page
        // return view('profile/education');
        return view('profile/education-add', compact('educations'));
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
        return view('profile/prof-exp');
    }

    public function tax()
    {
        return view('profile/tax-info');
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
        $response['success'] = '0';
        $user = Sentinel::getUser();
        //update values
        $user->update($request->except('user_id'));

        // Was the user updated?
        if ($user->save()) {
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
            if ($input['education_id'][$key] != 0) {
                $education = Education::find($input['education_id'][$key]);
                $education->user_id = $user->id;
                $education->education_type = $input['graduation_type'][$key];
                $education->graduation_type = $input['graduation_type'][$key];
                $education->name = $input['name'][$key];
                $education->month = $input['month'][$key];
                $education->year = $input['year'][$key];
                $education->degree = $input['degree'][$key];
                $education->save();   
            } else {
                $education = new Education;
                $education->user_id = $user->id;
                $education->education_type = $input['graduation_type'][$key];
                $education->graduation_type = $input['graduation_type'][$key];
                $education->name = $input['name'][$key];
                $education->month = $input['month'][$key];
                $education->year = $input['year'][$key];
                $education->degree = $input['degree'][$key];
                $education->save();
            }
            
        }
        return redirect('profile/certification')->with('success', 'Education updated successfully');
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
                $certificate->valid_till = $input['valid_till'][$key];
                $certificate->display_status = 1;
                $certificate->save();   
            } else {
                $certificate = new Certificate;
                $certificate->user_id = $user->id;
                $certificate->certificate_no = $input['certificate_no'][$key];
                $certificate->name = $input['name'][$key];
                $certificate->valid_till = $input['valid_till'][$key];
                $certificate->display_status = 1;
                $certificate->save();
            }
        }

        return redirect('profile/professional-experience')->with('success', 'Certificate updated successfully');
    }

    public function uploadProfilePic(Request $request)
    {
        $data = $request->all();
        $response['success'] = '0';
        $user = Sentinel::getUser();

        $address_image_parts = explode(";base64,", $data['fileData']);
        $address_image_type_aux = explode("image/", $address_image_parts[0]);
        $address_image_type = $address_image_type_aux[1];
        $address_image_base64 = $address_image_parts[1];
        $address_file = base64_decode($address_image_base64);
        $address_filename = str_random(10).'.'.$address_image_type;
        $address_path = $_SERVER['DOCUMENT_ROOT'].'/uploads/users/'.$address_filename;
        file_put_contents($address_path, $address_file);
        // $fileData = '/uploads/users/' . $address_filename;

        $user->pic =url('/').'/uploads/users/'.$address_filename;

        // Was the user updated?
        if ($user->save()) {
            // Prepare the success message
            $success = 'Profile Pic Updated successfully';
            //Activity log for update account
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('Profile Pic Updated successfully');
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

}
