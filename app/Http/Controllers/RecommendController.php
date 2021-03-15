<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecommendProject;

class RecommendController extends Controller
{
    public function index()
    {
        return view('recommendation/recommend');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $recommend = new RecommendProject();
        $recommend->project_proposal_id = $input['project_proposal_id'];
        $recommend->project_id = $input['project_id'];
        $recommend->description = $input['description'];
        $recommend->save();
       
        return redirect('freelancer/recommend')->with('success', 'Recommand Project Successfully!');
    
    }
}
