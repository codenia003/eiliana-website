<?php namespace App\Http\Controllers\Api;

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
use App\Models\Project;
use stdClass;
use Carbon\Carbon;

class ProjectController extends JoshController
{
    /**
     * Profile.
     *
     * @return View
     */

    public function fetchProjectStatus() {
        // get the current time
        $project_status = DB::table('project_status')->get();
        return response()->json($trialExpires);
    }

    public function getSearchProject(Request $request)
    {
        $sound = "";
        $words = explode(" " , $request->input('keyword')) ;
        foreach($words as $word) {
            $sound .= metaphone($word);
            if (next($words)==true) {
                $sound .= " ";
            };
        }
        // print_r($sound);
        // $projects = Project::where('indexing', $sound)->get();
        $result = Project::where('indexing', 'LIKE', '%'.$sound.'%')->get();
        
        $id = DB::table('search_keyword')->insertGetId(
            ['user_id' => $request->input('user_id'), 'keyword' => $request->input('keyword')]
        );

        $details = array();

        foreach($result as $key => $res)        
        {
            $from = strtotime($res['expiry_datetime']);
            $today = time();
            $difference = $from - $today;

            $details[$key]['project_id'] = $res['project_id'];
            $details[$key]['posted_by_user_id'] = $res['posted_by_user_id'];
            $details[$key]['project_status_id'] = $res['project_status_id'];
            $details[$key]['post_datetime'] = $res['post_datetime'];
            $details[$key]['expiry_datetime'] = $res['expiry_datetime'];
            $details[$key]['expiry_days'] = floor($difference / 86400);
            $details[$key]['project_name'] = $res['project_name'];
            $details[$key]['project_description'] = $res['project_description'];
            $details[$key]['payment_type_id'] = $res['payment_type_id'];
            $details[$key]['project_awarded_to_user_id'] = $res['project_awarded_to_user_id'];
            $details[$key]['language_id'] = $res['language_id'];
            $details[$key]['currency_id'] = $res['currency_id'];
        }

        $response['success'] = '1';
        $response['count'] = count($details);
        $response['projects'] = $details;

        return response()->json($response);
    }

    public function getProjectDeatils(Request $request)
    {
        $project = Project::where('project_id', $request->input('id'))->first();
        
        $from = strtotime($project['expiry_datetime']);
        $today = time();
        $difference = $from - $today;

        $project['expiry_days'] = floor($difference / 86400);
        return response()->json($project);
    }

    public function getAllProject(Request $request)
    {
        $projects = Project::where('posted_by_user_id', $request->input('user_id'))->get();
        return response()->json($projects);
    }

    public function createProject(Request $request)
    {
        $current = Carbon::now();
        $projectExpires = $current->addDays(7);

        $project = new Project;
        $project->posted_by_user_id = $request->input('user_id');
        $project->project_status_id = '1';
        $project->expiry_datetime = $projectExpires;
        $project->project_name = $request->input('project_name');
        $project->project_description = $request->input('project_description');
        $project->payment_type_id = $request->input('payment_type_id');
        $project->project_awarded_to_user_id = '0';
        $project->language_id = '0';
        $project->currency_id = '0';
        $project->indexing = '0';
        $project->save();
        
        $response['success'] = '1';
        $response['errors'] = 'Updated';
        $response['project'] = $project;
        return response()->json($response);
    }

    public function getProjectById(Request $request)
    {
        $education = Project::where('education_id', $request->input('id'))->first();
        return response()->json($education);
    }

    public function updateProject(Request $request)
    {
        $education = Project::find($request->input('id'));
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

}
