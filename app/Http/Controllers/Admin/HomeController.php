<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HomePageRepository;
use Illuminate\Support\Facades\Lang;
use App\Models\HomePage;
use Flash;

class HomeController extends Controller
{

    /** @var  HomePageRepository */
    private $homePageRepository;

    public function __construct(HomePageRepository $homePageRepo)
    {
        $this->homePageRepository = $homePageRepo;
    }

    public function index(Request $request)
    {

        $homePage = $this->homePageRepository->all();
        $homePage_count = $this->homePageRepository->count();
        return view('admin.homePage.index', compact('homePage','homePage_count'));
    }

    /**
     * Show the form for creating a new ProjectCategory.
     *
     * @return Response
     */
    public function create()
    { 
        return view('admin.homePage.create');
    }

    /**
     * Store a newly created ProjectCategory in storage.
     *
     * @param CreateProjectCategoryRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $homePage = $this->homePageRepository->create($input);

        Flash::success('Home page saved successfully.');

        return redirect(route('admin.homePage.index'));
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
        $homePage = $this->homePageRepository->findWithoutFail($id);

        if (empty($homePage)) {
            Flash::error('Home page not found');

            return redirect(route('homePage.index'));
        }

        return view('admin.homePage.show')->with('homePage', $homePage);
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
        $homePage = $this->homePageRepository->findWithoutFail($id);
        if (empty($homePage)) {
            Flash::error('Home page not found');

            return redirect(route('homePage.index'));
        }

        return view('admin.homePage.edit', compact('homePage'));
    }

    /**
     * Update the specified ProjectCategory in storage.
     *
     * @param  int              $id
     * @param UpdateProjectCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $homePage = $this->homePageRepository->findWithoutFail($id);
        $input = $request->all();

        if (empty($homePage)) {
            Flash::error('Home page not found');

            return redirect(route('homePage.index'));
        }

        $homePage = $this->homePageRepository->update($input, $id);

        Flash::success('Home page updated successfully.');

        return redirect(route('admin.homePage.index'));
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
          $confirm_route =  route('admin.homePage.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = HomePage::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.homePage.index'))->with('success', Lang::get('message.success.delete'));

       }
}
