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
use stdClass;
use Carbon\Carbon;


class AdvanceSearchController extends Controller
{
    public function projects()
    {
        // Show the page
        return view('search/projects');
    }

    public function contractStaffing()
    {
        // Show the page
        return view('search/contract-staffing');
    }
}
