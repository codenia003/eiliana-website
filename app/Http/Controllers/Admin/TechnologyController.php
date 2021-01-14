<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Repositories\TechnologyRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Technology;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class TechnologyController extends InfyOmBaseController
{
    /** @var  TechnologyRepository */
    private $technologyRepository;

    public function __construct(TechnologyRepository $technologyRepo)
    {
        $this->technologyRepository = $technologyRepo;
    }

    /**
     * Display a listing of the Technology.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->technologyRepository->pushCriteria(new RequestCriteria($request));
        $technologies = $this->technologyRepository->where('display_status', '1')->get();

        return view('admin.technologies.index')
            ->with('technologies', $technologies);
    }

    /**
     * Show the form for creating a new Technology.
     *
     * @return Response
     */
    public function create()
    {   
        $technologies = $this->technologyRepository->where('display_status', '1')->where('parent_id', '0')->get(); 
          
        return view('admin.technologies.create',compact('technologies'));
    }

    /**
     * Store a newly created Technology in storage.
     *
     * @param CreateTechnologyRequest $request
     *
     * @return Response
     */
    public function store(CreateTechnologyRequest $request)
    {
        $input = $request->all();

        $technology = $this->technologyRepository->create($input);

        Flash::success('Technology saved successfully.');

        return redirect(route('admin.technologies.index'));
    }

    /**
     * Display the specified Technology.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $technology = $this->technologyRepository->findWithoutFail($id);

        if (empty($technology)) {
            Flash::error('Technology not found');

            return redirect(route('technologies.index'));
        }

        return view('admin.technologies.show')->with('technology', $technology);
    }

    /**
     * Show the form for editing the specified Technology.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $technology = $this->technologyRepository->findWithoutFail($id);
         $technologies = $this->technologyRepository->where('display_status', '1')->where('parent_id', '0')->get(); 

        if (empty($technology)) {
            Flash::error('Technology not found');

            return redirect(route('technologies.index'));
        }

        // return view('admin.technologies.edit')->with('technology', $technology);
        return view('admin.technologies.edit',compact('technology','technologies'));
    }

    /**
     * Update the specified Technology in storage.
     *
     * @param  int              $id
     * @param UpdateTechnologyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTechnologyRequest $request)
    {
        $technology = $this->technologyRepository->findWithoutFail($id);

        

        if (empty($technology)) {
            Flash::error('Technology not found');

            return redirect(route('technologies.index'));
        }

        $technology = $this->technologyRepository->update($request->all(), $id);

        Flash::success('Technology updated successfully.');

        return redirect(route('admin.technologies.index'));
    }

    /**
     * Remove the specified Technology from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.technologies.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Technology::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.technologies.index'))->with('success', Lang::get('message.success.delete'));

       }

}
