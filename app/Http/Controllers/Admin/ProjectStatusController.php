<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateProjectStatusRequest;
use App\Http\Requests\UpdateProjectStatusRequest;
use App\Repositories\ProjectStatusRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\ProjectStatus;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProjectStatusController extends InfyOmBaseController
{
    /** @var  ProjectStatusRepository */
    private $projectStatusRepository;

    public function __construct(ProjectStatusRepository $projectStatusRepo)
    {
        $this->projectStatusRepository = $projectStatusRepo;
    }

    /**
     * Display a listing of the ProjectStatus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->projectStatusRepository->pushCriteria(new RequestCriteria($request));
        $projectStatuses = $this->projectStatusRepository->all();
        return view('admin.projectStatuses.index')
            ->with('projectStatuses', $projectStatuses);
    }

    /**
     * Show the form for creating a new ProjectStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.projectStatuses.create');
    }

    /**
     * Store a newly created ProjectStatus in storage.
     *
     * @param CreateProjectStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectStatusRequest $request)
    {
        $input = $request->all();

        $projectStatus = $this->projectStatusRepository->create($input);

        Flash::success('ProjectStatus saved successfully.');

        return redirect(route('admin.projectStatuses.index'));
    }

    /**
     * Display the specified ProjectStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projectStatus = $this->projectStatusRepository->findWithoutFail($id);

        if (empty($projectStatus)) {
            Flash::error('ProjectStatus not found');

            return redirect(route('projectStatuses.index'));
        }

        return view('admin.projectStatuses.show')->with('projectStatus', $projectStatus);
    }

    /**
     * Show the form for editing the specified ProjectStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projectStatus = $this->projectStatusRepository->findWithoutFail($id);

        if (empty($projectStatus)) {
            Flash::error('ProjectStatus not found');

            return redirect(route('projectStatuses.index'));
        }

        return view('admin.projectStatuses.edit')->with('projectStatus', $projectStatus);
    }

    /**
     * Update the specified ProjectStatus in storage.
     *
     * @param  int              $id
     * @param UpdateProjectStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectStatusRequest $request)
    {
        $projectStatus = $this->projectStatusRepository->findWithoutFail($id);

        

        if (empty($projectStatus)) {
            Flash::error('ProjectStatus not found');

            return redirect(route('projectStatuses.index'));
        }

        $projectStatus = $this->projectStatusRepository->update($request->all(), $id);

        Flash::success('ProjectStatus updated successfully.');

        return redirect(route('admin.projectStatuses.index'));
    }

    /**
     * Remove the specified ProjectStatus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.projectStatuses.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ProjectStatus::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.projectStatuses.index'))->with('success', Lang::get('message.success.delete'));

       }

}
