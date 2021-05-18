<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Redirect;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Session;

class GoogleAuthController extends Controller
{
    protected $messageBag = null;

    /**
     * Initializer.
     */
    public function __construct()
    {
        $this->messageBag = new MessageBag;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
        $array = User::withTrashed()->where(
            [
            ['email', '=', $user->email],
            ['deleted_at', '!=', null]
            ]
        )->get();

        return $array->isEmpty()
            ? $this->findOrCreateUser($user, 'google')
            : $this->sendFailedResponse("You are banned.");
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect('login')->withInput()->with('error', 'Unable to login, try with another provider to login.');
    }

    public function findOrCreateUser($providerUser, $provider)
    {
        $name = $providerUser->name;
        $splitName = explode(' ', $name);
        $first_name = '';
        $last_name = $splitName[count($splitName) - 1];
        for ($i = 0; $i <= count($splitName) - 2; $i++) {
            $first_name = $first_name . $splitName[$i] . ' ';
        }
        // check for already has account
        $user = User::where('email', $providerUser->email)->first();

        // if user already found
        if (!$user) {

            if(Session::get('teaminvitation')['to_user']) {
                $id = DB::table('user_registration_social')->insertGetId(
                    ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $providerUser->email, 'pic' => $providerUser->avatar, 'provider' => $provider, 'provider_id' => $providerUser->id, 'provider_as' => $provider, 'user_type_parent_id' => Session::get('teaminvitation')['user_bid']]
                );
            } else {
                $id = DB::table('user_registration_social')->insertGetId(
                    ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $providerUser->email, 'pic' => $providerUser->avatar, 'provider' => $provider, 'provider_id' => $providerUser->id, 'provider_as' => $provider]
                );
            }

            session()->forget('registration_social');
            session()->put('registration_social', $id);

            return Redirect::route("registerbasic")->with('success', 'Please Fill this form for registration');

            // $user = User::create(
            //     [
            //     'first_name' => $first_name,
            //     'last_name' => $last_name,
            //     'email' => $providerUser->email,
            //     'pic' => $providerUser->avatar,
            //     'provider' => $provider,
            //     'password' => '',
            //     'mobile' => '',
            //     'username' => $first_name.$last_name,
            //     'registration_id' => 0,
            //     'provider_id' => $providerUser->id

            //     ]
            // );
            // $role = Sentinel::findRoleById(2);

            // if ($role) {
            //     $role->users()->attach($user);
            // }
            // activity($user->full_name)
            //     ->performedOn($user)
            //     ->causedBy($user)
            //     ->log('Registered');
            // if (Activation::completed($user) == false) {
            //     $activation = Activation::create($user);
            //     Activation::complete($user, $activation->code);
            // }
        }
        activity($user->full_name)
            ->performedOn($user)
            ->causedBy($user)
            ->log('Logged In');

        try {
            if (Sentinel::authenticate($user)) {

                $role_users = DB::table('role_users')->where('user_id', $user->id)->first();

                $user['role'] = $role_users->role_id;
                $country_name = DB::table('countries')->where('id', $user->country)->first();

                $user['country_name'] = $country_name->name;

                if(session()->has('url.intended')) {
                    $response_url = session()->get('url.intended');
                } else {
                    $response_url = url()->to('/home');
                }
                session()->put('users', $user);

                if($user->register_as == '3') {
                    return Redirect::route("loginas")->with('success', 'Please select login as');
                } else {
                    $user['login_as'] = $user->register_as;
                }


                return Redirect::to($response_url)->with('success', 'Login successfully');
            }
        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_activated'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', trans('auth/message.account_suspended', compact('delay')));
        }
        return Redirect::route('login')->withInput()->withErrors($this->messageBag);
    }
}
