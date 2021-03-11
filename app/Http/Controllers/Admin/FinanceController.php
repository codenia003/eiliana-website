<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\FinanceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Lang;
use App\Models\Finance;
use App\Models\ProjectLeads;
use App\Notifications\UserNotification;


class FinanceController extends Controller
{

    /** @var  FinanceRepository */
    private $financeRepository;

    public function __construct(FinanceRepository $financeRepo)
    {
        $this->financeRepository = $financeRepo;
    }

    public function index(Request $request)
    {
        $finances = Finance::with('userprojects','userprojects.projectdetail','userprojects.fromuser','userprojects.projectdetail.companydetails')->get();
        //return $finances;
        return view('admin.finance.index', compact('finances'));
    }

    public function edit($id)
    {      
        $finance =  ProjectLeads::with('projectdetail','contractdetails','contractdetails.orderinvoice','contractdetails.paymentschedule','contractdetails.advacne_amount')->where('project_leads_id', $id)->first();

        //return $finance;
        return view('admin.finance.edit', compact('finance'));
    }

    public function update($id, Request $request)
    {

       $finance = $this->financeRepository->findWithoutFail($id);

        if (empty($finance)) {
            Flash::error('Finance not found');

            return redirect(route('admin.finances.index'));
        }

        $finance = $this->financeRepository->update($request->all(), $id);

        Flash::success('Finance updated successfully.');
        return redirect(route('admin.finances.index'));
    }


}
