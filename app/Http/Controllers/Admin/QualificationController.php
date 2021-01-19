<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Repositories\QualificationRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Qualification;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QualificationController extends InfyOmBaseController
{
    /** @var  QualificationRepository */
    private $qualificationRepository;

    public function __construct(QualificationRepository $qualificationRepo)
    {
        $this->qualificationRepository = $qualificationRepo;
    }

    /**
     * Display a listing of the Qualification.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->qualificationRepository->pushCriteria(new RequestCriteria($request));
        $qualifications = $this->qualificationRepository->all();
        return view('admin.qualifications.index')
            ->with('qualifications', $qualifications);
    }

    /**
     * Show the form for creating a new Qualification.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.qualifications.create');
    }

    /**
     * Store a newly created Qualification in storage.
     *
     * @param CreateQualificationRequest $request
     *
     * @return Response
     */
    public function store(CreateQualificationRequest $request)
    {
        $input = $request->all();

        $qualification = $this->qualificationRepository->create($input);

        Flash::success('Qualification saved successfully.');

        return redirect(route('admin.qualifications.index'));
    }

    /**
     * Display the specified Qualification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        return view('admin.qualifications.show')->with('qualification', $qualification);
    }

    /**
     * Show the form for editing the specified Qualification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        return view('admin.qualifications.edit')->with('qualification', $qualification);
    }

    /**
     * Update the specified Qualification in storage.
     *
     * @param  int              $id
     * @param UpdateQualificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQualificationRequest $request)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        $qualification = $this->qualificationRepository->update($request->all(), $id);

        Flash::success('Qualification updated successfully.');

        return redirect(route('admin.qualifications.index'));
    }

    /**
     * Remove the specified Qualification from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.qualifications.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Qualification::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.qualifications.index'))->with('success', Lang::get('message.success.delete'));

       }

}
