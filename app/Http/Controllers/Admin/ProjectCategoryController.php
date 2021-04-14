<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateProjectCategoryRequest;
use App\Http\Requests\UpdateProjectCategoryRequest;
use App\Repositories\ProjectCategoryRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\ProjectCategory;
use Flash;
use Illuminate\Support\Str;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProjectCategoryController extends InfyOmBaseController
{
    /** @var  ProjectCategoryRepository */
    private $projectCategoryRepository;

    public function __construct(ProjectCategoryRepository $projectCategoryRepo)
    {
        $this->projectCategoryRepository = $projectCategoryRepo;
    }

    /**
     * Display a listing of the ProjectCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->projectCategoryRepository->pushCriteria(new RequestCriteria($request));
        $projectCategories = $this->projectCategoryRepository->all();
        $parentProjectCategories = $this->projectCategoryRepository->where('display_status', '1')->where('parent_id', '0')->get(); 
        return view('admin.projectCategories.index')
            ->with('projectCategories', $projectCategories)->with('parentProjectCategories', $parentProjectCategories);
    }

    /**
     * Show the form for creating a new ProjectCategory.
     *
     * @return Response
     */
    public function create()
    { 
        $projectCategory = '0';
        $parentProjectCategories = $this->projectCategoryRepository->where('display_status', '1')->where('parent_id', '0')->get(); 
        return view('admin.projectCategories.create', compact('parentProjectCategories','projectCategory'));
    }

    /**
     * Store a newly created ProjectCategory in storage.
     *
     * @param CreateProjectCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectCategoryRequest $request)
    {
        $input = $request->all();
        $slug = Str::slug($request->name, '-');

        $data = array(
             'name' => $request->name,
             'parent_id' => $request->parent_id,
             'slug' => $slug,
             'descriptor' => $request->descriptor,
             'heading' => $request->heading,
             'keywords' => $request->keywords
        );

        $projectCategory = $this->projectCategoryRepository->create($data);

        Flash::success('ProjectCategory saved successfully.');

        return redirect(route('admin.projectCategories.index'));
    }
    /**
     * Display the specified ProjectCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projectCategory = $this->projectCategoryRepository->findWithoutFail($id);

        if (empty($projectCategory)) {
            Flash::error('ProjectCategory not found');

            return redirect(route('projectCategories.index'));
        }

        return view('admin.projectCategories.show')->with('projectCategory', $projectCategory);
    }

    /**
     * Show the form for editing the specified ProjectCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projectCategory = $this->projectCategoryRepository->findWithoutFail($id);
        $parentProjectCategories = $this->projectCategoryRepository->where('display_status', '1')->where('parent_id', '0')->get(); 

        if (empty($projectCategory)) {
            Flash::error('ProjectCategory not found');

            return redirect(route('projectCategories.index'));
        }

        return view('admin.projectCategories.edit', compact('projectCategory','parentProjectCategories'));
    }

    /**
     * Update the specified ProjectCategory in storage.
     *
     * @param  int              $id
     * @param UpdateProjectCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectCategoryRequest $request)
    {
        $projectCategory = $this->projectCategoryRepository->findWithoutFail($id);

        $slug = Str::slug($request->name, '-');
        $data = array(
             'name' => $request->name,
             'parent_id' => $request->parent_id,
             'slug' => $slug,
             'descriptor' => $request->descriptor,
             'heading' => $request->heading,
             'keywords' => $request->keywords
        );

        if (empty($projectCategory)) {
            Flash::error('ProjectCategory not found');

            return redirect(route('projectCategories.index'));
        }

        $projectCategory = $this->projectCategoryRepository->update($data, $id);

        Flash::success('ProjectCategory updated successfully.');

        return redirect(route('admin.projectCategories.index'));
    }

    /**
     * Remove the specified ProjectCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.projectCategories.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ProjectCategory::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.projectCategories.index'))->with('success', Lang::get('message.success.delete'));

       }

}
