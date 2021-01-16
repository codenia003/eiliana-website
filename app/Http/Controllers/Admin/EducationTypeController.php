<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateEducationTypeRequest;
use App\Http\Requests\UpdateEducationTypeRequest;
use App\Repositories\EducationTypeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\EducationType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EducationTypeController extends InfyOmBaseController
{
    /** @var  EducationTypeRepository */
    private $educationTypeRepository;

    public function __construct(EducationTypeRepository $educationTypeRepo)
    {
        $this->educationTypeRepository = $educationTypeRepo;
    }

    /**
     * Display a listing of the EducationType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->educationTypeRepository->pushCriteria(new RequestCriteria($request));
        $educationTypes = $this->educationTypeRepository->all();
        return view('admin.educationTypes.index')
            ->with('educationTypes', $educationTypes);
    }

    /**
     * Show the form for creating a new EducationType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.educationTypes.create');
    }

    /**
     * Store a newly created EducationType in storage.
     *
     * @param CreateEducationTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateEducationTypeRequest $request)
    {   
        
        $input = $request->all();

        $educationType = $this->educationTypeRepository->create($input);

        Flash::success('EducationType saved successfully.');

        return redirect(route('admin.educationTypes.index'));
    }

    /**
     * Display the specified EducationType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $educationType = $this->educationTypeRepository->findWithoutFail($id);

        if (empty($educationType)) {
            Flash::error('EducationType not found');

            return redirect(route('educationTypes.index'));
        }

        return view('admin.educationTypes.show')->with('educationType', $educationType);
    }

    /**
     * Show the form for editing the specified EducationType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $educationType = $this->educationTypeRepository->findWithoutFail($id);

        if (empty($educationType)) {
            Flash::error('EducationType not found');

            return redirect(route('educationTypes.index'));
        }

        return view('admin.educationTypes.edit')->with('educationType', $educationType);
    }

    /**
     * Update the specified EducationType in storage.
     *
     * @param  int              $id
     * @param UpdateEducationTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEducationTypeRequest $request)
    {
        $educationType = $this->educationTypeRepository->findWithoutFail($id);

        

        if (empty($educationType)) {
            Flash::error('EducationType not found');

            return redirect(route('educationTypes.index'));
        }

        $educationType = $this->educationTypeRepository->update($request->all(), $id);

        Flash::success('EducationType updated successfully.');

        return redirect(route('admin.educationTypes.index'));
    }

    /**
     * Remove the specified EducationType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.educationTypes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = EducationType::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.educationTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
