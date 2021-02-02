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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use stdClass;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ChatMessage;
use App\Notifications\ChatNotification;

class ChatController extends JoshController
{
    public function fetchChatHistory(Request $request)
    {
        $input = $request->except('_token');
        $response['success'] = '0';

        $user = Sentinel::getUser();
        $input['user_id'] = $user->id;
        $output = '';

        $chat_message = ChatMessage::where('from_user_id', $user->id)->where('to_user_id', $input['to_user_id'])->orWhere(function($query) use ($input) {
                            $query->where('from_user_id', $input['to_user_id'])
                                ->where('to_user_id', $input['user_id']);
                        })->latest()->get();

        $output .= '<ul class="list-unstyled">';
        foreach($chat_message as $row)
        {
            $user_name = '';
            $dynamic_background = '';
            $chat_message = '';
            if($row["from_user_id"] == $user->id)
            {
                if($row["status"] == '2')
                {
                    $chat_message = '<em>This message has been removed</em>';
                    $user_name = '<b class="text-success">You</b>';
                }
                else
                {
                    $chat_message = $row['chat_message'];
                    $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
                }


                $dynamic_background = 'background-color:#ffe6e6;';
            }
            else
            {
                if($row["status"] == '2')
                {
                    $chat_message = '<em>This message has been removed</em>';
                }
                else
                {
                    $chat_message = $row["chat_message"];
                }
                $username = User::find($row["from_user_id"]);
                $user_name = '<b class="text-danger">'.$username->full_name.'</b>';
                $dynamic_background = 'background-color:#ffffe6;';
            }
            $output .= '
            <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
                <p>'.$user_name.' - '.$chat_message.'
                    <div align="right">
                        - <small><em>'.$row['created_at'].'</em></small>
                    </div>
                </p>
            </li>
            ';
        }
        $output .= '</ul>';

        return response()->json($output);
    }

    public function insertChat(Request $request){

        $input = $request->except('_token');
        $response['success'] = '1';

        $chatmessage = new ChatMessage;
        $chatmessage->from_user_id = Sentinel::getUser()->id;
        $chatmessage->to_user_id = $input['to_user_id'];
        $chatmessage->chat_message = $input['chat_message'];
        $chatmessage->chat_type  = $input['chat_type'];
        $chatmessage->status = '1';
        $chatmessage->save();

        $user = User::find($input['to_user_id']);
        if($input['chat_type'] == '2'){
            $url = '';
        } elseif($input['chat_type'] == '3'){
            $url = '';
        } elseif($input['chat_type'] == '4'){
            $url = 'client/my-requirement';
        } else {
            $url = '';
        }
        $details = [
            'greeting' => 'Hi '.$user->full_name,
            'body' => 'You have new opportunity',
            'thanks' => 'Thank you for using eiliana.com!',
            'actionText' => 'View My Site',
            'actionURL' => $url,
            'main_id' => $chatmessage->chat_message_id
        ];

        Notification::send($user, new ChatNotification($details));

        return response()->json($response);

    }
}
