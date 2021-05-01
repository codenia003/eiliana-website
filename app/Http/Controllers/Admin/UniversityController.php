<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Repositories\UniversityRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\University;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UniversityController extends InfyOmBaseController
{
    /** @var  UniversityRepository */
    private $universityRepository;

    public function __construct(UniversityRepository $universityRepo)
    {
        $this->universityRepository = $universityRepo;
    }

    /**
     * Display a listing of the University.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->universityRepository->pushCriteria(new RequestCriteria($request));
        $universities = $this->universityRepository->all();
        return view('admin.universities.index')
            ->with('universities', $universities);
    }

    /**
     * Show the form for creating a new University.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.universities.create');
    }

    /**
     * Store a newly created University in storage.
     *
     * @param CreateUniversityRequest $request
     *
     * @return Response
     */
    public function store(CreateUniversityRequest $request)
    {
        $input = $request->all();
        
        $fileName = "";
        if (!empty($input['logo'])) {
            $fileName = str_random(20).'.'.$request->logo->extension(); 
            $request->logo->move(public_path('uploads/university/'), $fileName);
            $input['logo'] = $fileName;
        }

        $university = $this->universityRepository->create($input);

        Flash::success('University saved successfully.');

        return redirect(route('admin.universities.index'));
    }

    /**
     * Display the specified University.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $university = $this->universityRepository->findWithoutFail($id);

        if (empty($university)) {
            Flash::error('University not found');

            return redirect(route('universities.index'));
        }

        return view('admin.universities.show')->with('university', $university);
    }

    /**
     * Show the form for editing the specified University.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $university = $this->universityRepository->findWithoutFail($id);

        if (empty($university)) {
            Flash::error('University not found');

            return redirect(route('universities.index'));
        }

        return view('admin.universities.edit')->with('university', $university);
    }

    /**
     * Update the specified University in storage.
     *
     * @param  int              $id
     * @param UpdateUniversityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUniversityRequest $request)
    {
        $university = $this->universityRepository->findWithoutFail($id);

        $input = $request->all();

        if (empty($university)) {
            Flash::error('University not found');

            return redirect(route('universities.index'));
        }

        $fileName = $university->logo;
        if ($request->hasFile('logo')) {
            $fileName = str_random(20).'.'.$request->logo->extension(); 
            $request->logo->move(public_path('uploads/university/'), $fileName);
        }
        $input['logo'] = $fileName;



        $university = $this->universityRepository->update($input, $id);

        Flash::success('University updated successfully.');

        return redirect(route('admin.universities.index'));
    }

    /**
     * Remove the specified University from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.universities.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = University::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.universities.index'))->with('success', Lang::get('message.success.delete'));

       }

}
