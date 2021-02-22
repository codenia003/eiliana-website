<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use View;
use DB;
use Mail;
use App\Mail\TeamInvite;
use App\Models\TeamInvitation;

class CompanayController extends JoshController
{

    public function index()
    {
        return view('team/teams');
    }

    public function registerTeams(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        foreach ($input['from'] as $key => $value) {

            $teaminvitation = new TeamInvitation;
            $teaminvitation->from_user_id = $user->id;
            $teaminvitation->to_user = $input['to_user'][$key];
            $teaminvitation->subject = $input['subject'][$key];
            $teaminvitation->message = $input['messagetext'][$key];
            $teaminvitation->token = str_random(30);
            $teaminvitation->status = 1;
            $teaminvitation->save();

            $data = [];

            $data['team_invitation_id'] = $teaminvitation->team_invitation_id;
            $data['token'] = $teaminvitation->token;
            $data['company_name'] = $user->company_name;
            $data['to_user'] = $teaminvitation->to_user;
            $data['subject'] = $teaminvitation->subject;
            $data['message'] = $teaminvitation->message;

            // print_r($data);
            // die;

            // Send the activation code through email
            Mail::to($user->email)
                ->send(new TeamInvitation($data));


        }

        return redirect('team/teams')->with('success', 'Invitation send successfully');
    }

}
