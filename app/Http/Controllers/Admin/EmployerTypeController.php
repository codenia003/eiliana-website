<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateEmployerTypeRequest;
use App\Http\Requests\UpdateEmployerTypeRequest;
use App\Repositories\EmployerTypeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\EmployerType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EmployerTypeController extends InfyOmBaseController
{
    /** @var  EmployerTypeRepository */
    private $employerTypeRepository;

    public function __construct(EmployerTypeRepository $employerTypeRepo)
    {
        $this->employerTypeRepository = $employerTypeRepo;
    }

    /**
     * Display a listing of the EmployerType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->employerTypeRepository->pushCriteria(new RequestCriteria($request));
        $employerTypes = $this->employerTypeRepository->all();
        return view('admin.employerTypes.index')
            ->with('employerTypes', $employerTypes);
    }

    /**
     * Show the form for creating a new EmployerType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.employerTypes.create');
    }

    /**
     * Store a newly created EmployerType in storage.
     *
     * @param CreateEmployerTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployerTypeRequest $request)
    {
        $input = $request->all();

        $employerType = $this->employerTypeRepository->create($input);

        Flash::success('EmployerType saved successfully.');

        return redirect(route('admin.employerTypes.index'));
    }

    /**
     * Display the specified EmployerType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employerType = $this->employerTypeRepository->findWithoutFail($id);

        if (empty($employerType)) {
            Flash::error('EmployerType not found');

            return redirect(route('employerTypes.index'));
        }

        return view('admin.employerTypes.show')->with('employerType', $employerType);
    }

    /**
     * Show the form for editing the specified EmployerType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employerType = $this->employerTypeRepository->findWithoutFail($id);

        if (empty($employerType)) {
            Flash::error('EmployerType not found');

            return redirect(route('employerTypes.index'));
        }

        return view('admin.employerTypes.edit')->with('employerType', $employerType);
    }

    /**
     * Update the specified EmployerType in storage.
     *
     * @param  int              $id
     * @param UpdateEmployerTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployerTypeRequest $request)
    {
        $employerType = $this->employerTypeRepository->findWithoutFail($id);

        

        if (empty($employerType)) {
            Flash::error('EmployerType not found');

            return redirect(route('employerTypes.index'));
        }

        $employerType = $this->employerTypeRepository->update($request->all(), $id);

        Flash::success('EmployerType updated successfully.');

        return redirect(route('admin.employerTypes.index'));
    }

    /**
     * Remove the specified EmployerType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.employerTypes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = EmployerType::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.employerTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
