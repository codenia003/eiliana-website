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


    public function educationAdd()
    {
        // Show the page
        return view('profile/education-add');
    }


    public function educationEdit()
    {
        // Show the page
        return view('profile/education-add');
    }


    public function certification()
    {
        // Show the page
        // return view('profile/certification');
        return view('profile/certification-add');
    }

    public function certificationAdd()
    {
        // Show the page
        return view('profile/certification-add');
    }

    public function professionalExperience()
    {
        // Show the page
        return view('profile/prof-exp');
    }

    public function tax()
    {
        // Show the page
        return view('profile/tax-info');
    }

    public function financial()
    {
        // Show the page
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

    public function getAllEducation(Request $request)
    {
        $users = Education::where('user_id', $request->input('user_id'))->with('educationtype')->get();
        return response()->json($users);
    }

    public function registerEducation(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');
        print_r($input);
        die();
        foreach ($input['education_type'] as $key => $value) {
            echo $input['education_type'][$key];
            echo $input['name'][$key];
            
            // $education = new Education;
            // $education->user_id = $user->id;
            // $education->education_type = $input['graduation_type'][$key];
            // $education->name = $input['name'][$key];
            // $education->month = $input['month'][$key];
            // $education->year = $input['year'][$key];
            // $education->degree = $input['degree'][$key];
            // $education->save();
        }
    
        // $response['errors'] = 'Updated';
        // $response['education'] = $education;
        return redirect('profile/certification')->with('success', 'Education added successfully');
    }

    public function getEducationById(Request $request)
    {
        $education = Education::where('education_id', $request->input('id'))->first();
        return response()->json($education);
    }

    public function updateEducation(Request $request)
    {
        $education = Education::find($request->input('id'));
        $education->user_id = $request->input('user_id');
        $education->education_type = $request->input('education_type');
        $education->name = $request->input('name');
        $education->from_date = $request->input('from_date');
        $education->to_date = $request->input('to_date');
        $education->degree = $request->input('degree');
        $education->area_of_education = $request->input('area_of_education');
        $education->description = $request->input('description');
        $education->save();

        $response['success'] = '1';
        $response['errors'] = 'Updated';
        $response['education'] = $education;
        return response()->json($response);
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
