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
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Location;
use App\Models\Technology;
use App\Models\Job;
use App\Models\ProjectLeads;
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

    public function getSearchProject(Request $request)
    {
        $pagename = [
        	'page_title' => 'Project Search',
        	'lookingfor' => '1'
        ];
        $user = Sentinel::getUser();

        if (empty($request->input('lookingfor'))) {
                $technologies = Technology::where('parent_id', '0')->get();
            $projectcategorys = ProjectCategory::all();
            $locations = Location::all();

            return view('project/search-project', compact('pagename','projectcategorys','locations','technologies'));
        } else {
            $data = $request->all();
            $contractsattfing = $data;
            $request->session()->forget('contractsattfing');
            $request->session()->put('contractsattfing', $contractsattfing);

            $sound = "";
            $words = explode(" " , $request->input('keyword')) ;
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

                $projects = Project::where('project_category', '=', $data['project_category'])->paginate(10);

                $count = count($projects);

                return view('search/browse-project', compact('count', 'projects'));
            } else {

                $jobs = Job::where('indexing', 'LIKE', '%'.$sound.'%')
                    ->orWhere('experience_year', '=', $request->input('experience_year'))
                    ->orWhere('experience_month', '=', $request->input('experience_month'))
                    ->paginate(10);

                return view('search/browse-job', compact('jobs'));

            }
        }


    }

    public function getProjectDeatils($id)
    {
        $project = Project::with('companydetails')->where('project_id', $id)->first();
        

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

    public function postProjectLead(Request $request){

        $input = $request->except('_token'); 
        $response['success'] = '0';
        $projectleadcheck = ProjectLeads::where('project_id', '=', $input['project_id'])->where('from_user_id', '=', Sentinel::getUser()->id)->first();
        if ($projectleadcheck === null) {
            $projectleads = new ProjectLeads;
            $projectleads->project_id = $input['project_id'];
            $projectleads->from_user_id = Sentinel::getUser()->id;
            $projectleads->subject = $input['subject'];
            $projectleads->message = $input['messagetext'];
            $projectleads->notify = '0';
            $projectleads->display_status = '1';
            $projectleads->lead_status = '1';
            $projectleads->save();

            $insertedId = $projectleads->project_leads_id;

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

}
