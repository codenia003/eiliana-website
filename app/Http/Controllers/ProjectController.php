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
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Location;
use stdClass;
use Carbon\Carbon;

class ProjectController extends JoshController
{
    /**
     * Profile.
     *
     * @return View
     */

    public function getSearchProject()
    {
        $pagename = [
        	'page_title' => 'Project Search',
        	'lookingfor' => '1'
        ];
        $projectcategorys = ProjectCategory::all();
        $locations = Location::all();

        return view('project/search-project', compact('pagename','projectcategorys','locations'));
    }

    public function postSearchProject(Request $request)
    {
        $user = Sentinel::getUser();

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
            ['user_id' => $user->id, 'keyword' => $request->input('keyword')]
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

        $success = '1';
        $keyword = $request->input('keyword');
        $count = count($details);
        $projects = $details;


        return view('browse-project', compact('count', 'projects', 'keyword'));
        // return response()->json($response);
    }

    public function getProjectDeatils($id)
    {
        $project = Project::where('project_id', $id)->first();

        $from = strtotime($project['expiry_datetime']);
        $today = time();
        $difference = $from - $today;

        $project['expiry_days'] = floor($difference / 86400);


        return view('project/project-details', compact('project'));
    }

    public function getAllProject(Request $request)
    {
        $projects = Project::where('posted_by_user_id', $request->input('user_id'))->get();
        return response()->json($projects);
    }

}
