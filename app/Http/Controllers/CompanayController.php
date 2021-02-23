<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Mail\TeamInvite;
use Sentinel;
use View;
use URL;
use Mail;
use App\Models\TeamInvitation;

class CompanayController extends JoshController
{

    public function index()
    {
        $user = Sentinel::getUser();

        $teaminvitations = TeamInvitation::where('from_user_id', $user->id)->paginate(15);

        return view('team/teams', compact('teaminvitations'));
    }

    public function registerTeams(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');

        foreach ($input['from'] as $key => $value) {

            do {
                $token = str_random(30);
            } while (TeamInvitation::where('token', $token)->first());

            $teaminvitation = new TeamInvitation;
            $teaminvitation->from_user_id = $user->id;
            $teaminvitation->to_user = $input['to_user'][$key];
            $teaminvitation->subject = $input['subject'][$key];
            $teaminvitation->message = $input['messagetext'][$key];
            $teaminvitation->token = $token;
            $teaminvitation->status = 1;
            $teaminvitation->save();

            // $data = [];

            $data['team_invitation_id'] = $teaminvitation->team_invitation_id;
            $data['token'] = $teaminvitation->token;
            $data['company_name'] = $user->company_name;
            $data['to_user'] = $teaminvitation->to_user;
            $data['subject'] = $teaminvitation->subject;
            $data['message'] = $teaminvitation->message;

            $url = URL::temporarySignedRoute(
                'acceptinvitation', now()->addMinutes(300), ['email' => $teaminvitation->to_user,'token' => $teaminvitation->token]
            );

            $data['url'] = $url;

            // Send the activation code through email
            Mail::send('emails.emailTemplates.teaminvite', $data, function ($m) use ($data) {
                $m->from('info@eiliana.com', $data['company_name']);
                $m->to($data['to_user'], '')->subject($data['company_name'].' invited you to join Eiliana');
            });



        }

        return redirect('company/teams')->with('success', 'The Invite has been sent successfully');
    }

    public function acceptInvitation(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->all();

        $teaminvitation = TeamInvitation::where('to_user', $input['email'])->where('token', $input['token'])->first();
        // dd($teaminvitation);

        if($teaminvitation === null) {
            abort(404);
        } else {
            if($teaminvitation->status == '0'){
                $teaminvitation = TeamInvitation::find($teaminvitation->team_invitation_id);;
                $teaminvitation->status = '1';
                $teaminvitation->save();

                $request->session()->forget('teaminvitation');
                $request->session()->put('teaminvitation', $teaminvitation);

                return redirect('account/register')->with('success', 'Invitation accepet successfully! Please regiter with us');
            } else {
                return redirect('account/login')->with('success', 'You already accepeted this inviatation!');
            }
        }

    }

}
