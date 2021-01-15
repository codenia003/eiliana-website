<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Repositories\DesignationRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Designation;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DesignationController extends InfyOmBaseController
{
    /** @var  DesignationRepository */
    private $designationRepository;

    public function __construct(DesignationRepository $designationRepo)
    {
        $this->designationRepository = $designationRepo;
    }

    /**
     * Display a listing of the Designation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->designationRepository->pushCriteria(new RequestCriteria($request));
        $designations = $this->designationRepository->all();
        return view('admin.designations.index')
            ->with('designations', $designations);
    }

    /**
     * Show the form for creating a new Designation.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.designations.create');
    }

    /**
     * Store a newly created Designation in storage.
     *
     * @param CreateDesignationRequest $request
     *
     * @return Response
     */
    public function store(CreateDesignationRequest $request)
    {
        $input = $request->all();

        $designation = $this->designationRepository->create($input);

        Flash::success('Designation saved successfully.');

        return redirect(route('admin.designations.index'));
    }

    /**
     * Display the specified Designation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $designation = $this->designationRepository->findWithoutFail($id);

        if (empty($designation)) {
            Flash::error('Designation not found');

            return redirect(route('designations.index'));
        }

        return view('admin.designations.show')->with('designation', $designation);
    }

    /**
     * Show the form for editing the specified Designation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $designation = $this->designationRepository->findWithoutFail($id);

        if (empty($designation)) {
            Flash::error('Designation not found');

            return redirect(route('designations.index'));
        }

        return view('admin.designations.edit')->with('designation', $designation);
    }

    /**
     * Update the specified Designation in storage.
     *
     * @param  int              $id
     * @param UpdateDesignationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDesignationRequest $request)
    {
        $designation = $this->designationRepository->findWithoutFail($id);

        

        if (empty($designation)) {
            Flash::error('Designation not found');

            return redirect(route('designations.index'));
        }

        $designation = $this->designationRepository->update($request->all(), $id);

        Flash::success('Designation updated successfully.');

        return redirect(route('admin.designations.index'));
    }

    /**
     * Remove the specified Designation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.designations.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Designation::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.designations.index'))->with('success', Lang::get('message.success.delete'));

       }

}
