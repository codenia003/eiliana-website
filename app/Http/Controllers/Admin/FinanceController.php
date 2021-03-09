<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.finance.index');
    }

    public function edit($id)
    {      
        return view('admin.finance.edit');
    }

    public function update($id, Request $request)
    {
       
        return redirect(route('admin.finances.index'));
    }


}
