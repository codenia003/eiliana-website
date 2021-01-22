<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateCandidateRoleRequest;
use App\Http\Requests\UpdateCandidateRoleRequest;
use App\Repositories\CandidateRoleRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\CandidateRole;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CandidateRoleController extends InfyOmBaseController
{
    /** @var  CandidateRoleRepository */
    private $candidateRoleRepository;

    public function __construct(CandidateRoleRepository $candidateRoleRepo)
    {
        $this->candidateRoleRepository = $candidateRoleRepo;
    }

    /**
     * Display a listing of the CandidateRole.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->candidateRoleRepository->pushCriteria(new RequestCriteria($request));
        $candidateRoles = $this->candidateRoleRepository->all();
        return view('admin.candidateRoles.index')
            ->with('candidateRoles', $candidateRoles);
    }

    /**
     * Show the form for creating a new CandidateRole.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.candidateRoles.create');
    }

    /**
     * Store a newly created CandidateRole in storage.
     *
     * @param CreateCandidateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateCandidateRoleRequest $request)
    {
        $input = $request->all();

        $candidateRole = $this->candidateRoleRepository->create($input);

        Flash::success('CandidateRole saved successfully.');

        return redirect(route('admin.candidateRoles.index'));
    }

    /**
     * Display the specified CandidateRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $candidateRole = $this->candidateRoleRepository->findWithoutFail($id);

        if (empty($candidateRole)) {
            Flash::error('CandidateRole not found');

            return redirect(route('candidateRoles.index'));
        }

        return view('admin.candidateRoles.show')->with('candidateRole', $candidateRole);
    }

    /**
     * Show the form for editing the specified CandidateRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $candidateRole = $this->candidateRoleRepository->findWithoutFail($id);

        if (empty($candidateRole)) {
            Flash::error('CandidateRole not found');

            return redirect(route('candidateRoles.index'));
        }

        return view('admin.candidateRoles.edit')->with('candidateRole', $candidateRole);
    }

    /**
     * Update the specified CandidateRole in storage.
     *
     * @param  int              $id
     * @param UpdateCandidateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCandidateRoleRequest $request)
    {
        $candidateRole = $this->candidateRoleRepository->findWithoutFail($id);

        

        if (empty($candidateRole)) {
            Flash::error('CandidateRole not found');

            return redirect(route('candidateRoles.index'));
        }

        $candidateRole = $this->candidateRoleRepository->update($request->all(), $id);

        Flash::success('CandidateRole updated successfully.');

        return redirect(route('admin.candidateRoles.index'));
    }

    /**
     * Remove the specified CandidateRole from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.candidateRoles.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = CandidateRole::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.candidateRoles.index'))->with('success', Lang::get('message.success.delete'));

       }

}
