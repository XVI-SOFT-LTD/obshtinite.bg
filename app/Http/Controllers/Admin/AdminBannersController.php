<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\BannersCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Admin\AdminDataTable;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\AdminBannersRequest;

class AdminBannersController extends AdminController
{
    protected $routes = 'banners';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'банер';
        $this->pluralPageTitle = 'банери';

        $this->i18nTable = 'banners_i18n';

        $this->model = new Banner();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък банери', 'url' => route($this->routes . '.index')],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $banners = $this->model->getAdminAll($request);

        $dataTable = new AdminDataTable();
        $dataTable->setPaginator($banners);
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на Банера',
            'logo' => 'Снимка',
            'category' => 'Категория',
            'active' => 'Активна',
            'homepage' => 'Показване на начална страница',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
            
        $dataTable->setRows($banners, [
            'name' => function ($banners) {
                return $banners->i18n->name;
            },
            'logo' => function ($banners) {
                return '<img src="' . $banners->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'category' => function ($banners) {
                $categoryNames = [];
                foreach ($banners->categories as $category) {
                    $categoryNames[] = $category->i18n->name;
                }
                return implode(', ', $categoryNames);
            },
            'homepage' => function ($banners) {
                return $banners->homepage ? 'Да' : 'Не';
            },
            'active' => function ($banners) {
                return $banners->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new banner.
     *
     * @return Factory|View
     */
    public function create()
    {
        /* breadcrumbs */
        $title = 'Добавяне на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        $areas = Area::getAreasForSelectAdmin();
        
        $categories = Category::getCategoriesAdmin();

        return view('admin.partials._form_create_custom')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('selectedAreas', [])
            ->with('selectedCategories', [])
            ->with('areas', $areas)
            ->with('categories', $categories)
            ->with('pageTitle', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminBannersRequest $request The request object.
     * @return RedirectResponse The redirect response.
     */
    public function store(AdminBannersRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;
        $requestData['i18n'][1]['keywords'] = json_encode($requestData['i18n'][1]['keywords']);
        dd($requestData);
        
        DB::transaction(function () use ($requestData, $request) {
            $banner = $this->model->create($requestData);
            $this->insertI18n($banner->id, 'banner_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $banner->id, Banner::DIR, Banner::SIZES);
                DB::table('banners')->where('id', $banner->id)->update(['logo' => $logo]);
            }

            if ($request->has('categories')) {
                $this->addRelatedCategoriesIds($request->get('categories'), $banner->id);
            }
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавено ' . $this->singularPageTitle);
    }

    /**
     * Edit a banner.
     *
     * @param int $id The ID of the banner to edit.
     * @return View The view for editing the banner.
     */
    public function edit(int $id): View
    {
        $banner = $this->model::findOrFail($id);
        $areas = Area::getAreasForSelectAdmin();
        $catogories = Category::getCategoriesAdmin();
        $selectedAreas = $this->model->getRelatedArea();
        $selectedCategories = (new BannersCategories())->getRelatedAssoc($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $banner)
            ->with('dir', $banner->getDir())
            ->with('size', Banner::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('selectedArea', $selectedAreas)
            ->with('areas', $areas)
            ->with('selectedCategories', $selectedCategories)
            ->with('catogories', $catogories);
    }

     /**
     * Update a participation.
     *
     * @param AdminParticipationsRequest $request The request object.
     * @param int $id The ID of the participation to update.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminBannersRequest $request, int $id): RedirectResponse
    {
        if (!$id) {
            return redirect()->back();
        }

        
        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;
        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;
        $requestData['i18n'][1]['keywords'] = json_encode($requestData['i18n'][1]['keywords']);
        
        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, Banner::DIR, Banner::SIZES);
        }
        
        DB::transaction(function () use ($requestData, $request, $id) {
            $banner = $this->model->findOrFail($id);
            $banner->update($requestData);

            $this->updateI18n($id, 'banner_id', $this->i18nTable, $requestData['i18n']);


            if ($request->has('categories')) {
                $this->addRelatedCategoriesIds($request->get('categories'), $id);
            }
        });

        return redirect()->back()->with('success', 'Успешно редактирано ' . $this->singularPageTitle);
    }


     /**
     * Delete a record from the database.
     *
     * @param int $id The ID of the record to be deleted.
     * @return JsonResponse The JSON response indicating the status of the deletion.
     */
    public function destroy(int $id)
    {
        try {
            $record = $this->model::findOrFail($id);
            $record->delete();
            return response()->json(['status' => 'success', 'message' => 'Записът беше успешно изтрит.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Записът не може да бъде изтрит.']);
        }
    }

    /**
     * Add related category IDs to a banner.
     *
     * This method first deletes any existing category associations for the given banner ID.
     * Then, it inserts new records for each category ID provided in the $categoriesIds array.
     *
     * @param array $categoriesIds An array of category IDs to be associated with the banner.
     * @param int $bannerId The ID of the banner to which the categories will be associated.
     * @return void
     */
    public function addRelatedCategoriesIds(array $categoriesIds, int $bannerId): void
    {
        BannersCategories::where('banner_id', $bannerId)->delete();

        foreach ($categoriesIds as $categoryId) {
            BannersCategories::insert([
                'banner_id' => $bannerId,
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}