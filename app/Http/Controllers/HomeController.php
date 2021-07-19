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
use App\Models\Job;
use App\Models\Technology;
use App\Models\ProjectCategory;
use App\Models\Location;
use App\Models\HomePage;

class HomeController extends JoshController
{
    public function index(Request $request)
    {
        $ipaddress = $request->ip();
        if ($ipaddress = '127.0.0.1') {
            $ipaddress = '47.15.222.10';
        } else {
            $ipaddress = $request->ip();   
        }
        
        $api_key = 'e32fad358f0351a2258c214c96efbb1894f2721c96a5ebadce9a92ecfc8cd4d6';

        $data = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$ipaddress&format=json");
        $data = json_decode($data);
        $country = $data->countryName;
        // print_r($country);
        // die;
        $request->session()->forget('countrydata');
        $request->session()->put('countrydata', $data);
        
        $jobs = Job::with('companydetails','locations')->latest()->limit(1)->get();
        $technologies = Technology::where('parent_id', '0')->get();
        $projectcategories = ProjectCategory::where('parent_id' , '0')->where('display_status', '1')->get();
        $locations = Location::all();
        $homepage = HomePage::first();
        // return $jobs;
        return view('index', compact('jobs','technologies','projectcategories','locations','homepage'));
    }

    public function categoryDetails($slug)
    {
        $projectcategorie = ProjectCategory::where('slug' , $slug)->first();
        // return $projectcategorie;
        return view('home.projectcategorie', compact('projectcategorie'));
    }

    public function getipdetails(Request $request) {
        
        $ipaddress = $request->ip();
        if ($ipaddress = '127.0.0.1') {
            $ipaddress = '47.15.222.10';
        } else {
            $ipaddress = $request->ip();   
        }

        $api_key = 'e32fad358f0351a2258c214c96efbb1894f2721c96a5ebadce9a92ecfc8cd4d6';

        $data = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$ipaddress&format=json");

        return $data;
        $data = json_decode($data);
        print_r($data);
        die;
    }
}
