<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Repositories\CurrencyRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Currency;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CurrencyController extends InfyOmBaseController
{
    /** @var  CurrencyRepository */
    private $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepo)
    {
        $this->currencyRepository = $currencyRepo;
    }

    /**
     * Display a listing of the Currency.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->currencyRepository->pushCriteria(new RequestCriteria($request));
        $currencies = $this->currencyRepository->all();
        return view('admin.currencies.index')
            ->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new Currency.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param CreateCurrencyRequest $request
     *
     * @return Response
     */
    public function store(CreateCurrencyRequest $request)
    {
        $input = $request->all();

        $currency = $this->currencyRepository->create($input);

        Flash::success('Currency saved successfully.');

        return redirect(route('admin.currencies.index'));
    }

    /**
     * Display the specified Currency.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $currency = $this->currencyRepository->findWithoutFail($id);

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        return view('admin.currencies.show')->with('currency', $currency);
    }

    /**
     * Show the form for editing the specified Currency.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $currency = $this->currencyRepository->findWithoutFail($id);

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        return view('admin.currencies.edit')->with('currency', $currency);
    }

    /**
     * Update the specified Currency in storage.
     *
     * @param  int              $id
     * @param UpdateCurrencyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurrencyRequest $request)
    {
        $currency = $this->currencyRepository->findWithoutFail($id);

        

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        $currency = $this->currencyRepository->update($request->all(), $id);

        Flash::success('Currency updated successfully.');

        return redirect(route('admin.currencies.index'));
    }

    /**
     * Remove the specified Currency from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.currencies.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Currency::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.currencies.index'))->with('success', Lang::get('message.success.delete'));

       }

}
