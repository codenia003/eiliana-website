<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Mail\TeamInvite;
use Sentinel;
use Session;
use View;
use URL;
use DB;
use Mail;
use App\Models\TeamInvitation;

class CompanayController extends JoshController
{

    public function index()
    {
        $user = Sentinel::getUser();
         // echo $user->id;
        //$id=$user->id;
        // if(Session::get('teaminvitation')['to_user'])
        // {
        //     $invite_user_email = Session::get('teaminvitation')['to_user'];
        //     $role = DB::select("select * from user_registration where email = '.$invite_user_email. '");
        //     $user_type_parent_id = $role->user_type_parent_id;
        //     // echo "<pre>";
        //     // print_r($role);
        //     // die;
        //     $teaminvitations = TeamInvitation::where('from_user_id', $user->id)->paginate(15);

        //     return view('team/bench', compact('teaminvitations','user_type_parent_id'));
        // }
        // else{
            $teaminvitations = TeamInvitation::where('from_user_id', $user->id)->paginate(15);
            return view('team/bench', compact('teaminvitations'));
        // }

    }
    public function teamsForm()
    {
        $user = Sentinel::getUser();
        // echo $user->id;
        //$id=$user->id;
        // if(Session::get('teaminvitation')['to_user'])
        // {
        //     $invite_user_email = Session::get('teaminvitation')['to_user'];
        //     $role = DB::select("select * from user_registration where email = '.$invite_user_email. '");
        //     if ($role->user_type_parent_id==1) {
        //     return view('errors/404');
        //     }
        //     else
        //     {
        //         return view('team/teams');
        //     }
        //     return view('team/teams');
        // }
        return view('team/teams');
    }

    public function registerTeams(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->except('_token');
        $response['success'] = '0';

        $teaminvitationcheck = TeamInvitation::where('to_user', '=', $input['to_user'])->first();
        if($teaminvitationcheck === null) {
            foreach($input['uname'] as $key => $value) {

                do {
                    $token = str_random(30);
                } while (TeamInvitation::where('token', $token)->first());

                $teaminvitation = new TeamInvitation;
                $teaminvitation->from_user_id = $user->id;
                $teaminvitation->name = $input['uname'][$key];
                $teaminvitation->to_user = $input['to_user'][$key];
                $teaminvitation->subject = $input['subject'][$key];
                $teaminvitation->message = $input['messagetext'][$key];
                $teaminvitation->user_bid = $input['user_bid'][$key];
                $teaminvitation->token = $token;
                $teaminvitation->status = 1;
                $teaminvitation->save();
                
                $response['success'] = '1';
                $response['msg']  = 'The Invite has been sent successfully';
                
                

                // $data = [];

                $data['team_invitation_id'] = $teaminvitation->team_invitation_id;
                $data['token'] = $teaminvitation->token;
                $data['user_bid'] = $teaminvitation->user_bid;
                $data['company_name'] = $user->company_name;
                $data['to_user'] = $teaminvitation->to_user;
                $data['subject'] = $teaminvitation->subject;
                $data['message'] = $teaminvitation->message;

                $url = URL::temporarySignedRoute(
                    'acceptinvitation', now()->addMinutes(300), ['email' => $teaminvitation->to_user,'token' => $teaminvitation->token,'user_type' => $teaminvitation->user_bid]
                );

                $data['url'] = $url;

                // Send the activation code through email
                Mail::send('emails.emailTemplates.teaminvite', $data, function ($m) use ($data) {
                    $m->from('info@eiliana.com', $data['company_name']);
                    $m->to($data['to_user'], '')->subject($data['company_name'].' invited you to join Eiliana');
                });
            }
        }else {
            $response['success'] = '2';
            $response['errors'] = 'This email already exits';
        }

        return response()->json($response);
    }

    public function acceptInvitation(Request $request)
    {
        $user = Sentinel::getUser();
        $input = $request->all();

        $teaminvitation = TeamInvitation::where('to_user', $input['email'])->where('token', $input['token'])->where('user_bid', $input['user_type'])->first();
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
