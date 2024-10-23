<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Admin\AdminDataTable;
use App\Http\Requests\Admin\AdminAreasRequest;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;

class AdminAreasController extends AdminController
{
    protected $routes = 'areas';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'област';
        $this->pluralPageTitle = 'области';

        $this->i18nTable = 'areas_i18n';

        $this->model = new Area();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък области', 'url' => route($this->routes . '.index')],
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
        $areas = $this->model->getAdminAll($request);

        $dataTable = new AdminDataTable();
        $dataTable->setPaginator($areas);
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на област',
            'logo' => 'Снимка',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setRows($areas, [
            'name' => function ($areas) {
                return $areas->i18n->name;
            },
            'logo' => function ($areas) {
                return '<img src="' . $areas->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'active' => function ($areas) {
                return $areas->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new area.
     *
     * @return Factory|View
     */
    public function create()
    {
        /* breadcrumbs */
        $title = 'Добавяне на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_create_custom')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('pageTitle', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminAreasRequest $request The request object.
     * @return RedirectResponse The redirect response.
     */
    public function store(AdminAreasRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);

        DB::transaction(function () use ($requestData, $request) {
            $area = $this->model->create($requestData);
            $this->insertI18n($area->id, 'area_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $area->id, Area::DIR, Area::SIZES);
                DB::table('areas')->where('id', $area->id)->update(['logo' => $logo]);
            }

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $area->id,
                    'areas_gallery',
                    'area_id',
                    Area::DIR_GALLERY,
                    Area::SIZES_GALLERY
                );
            }
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавена ' . $this->singularPageTitle);
    }

    /**
     * Edit a area.
     *
     * @param int $id The ID of the area to edit.
     * @return View The view for editing the area.
     */
    public function edit(int $id): View
    {
        $area = $this->model::findOrFail($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $area)
            ->with('dir', $area->getDir())
            ->with('size', Area::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('pageTitle', $title);
    }

    /**
     * Update a area.
     *
     * @param AdminAreasRequest $request The request object.
     * @param int $id The ID of the area to update.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminAreasRequest $request, int $id): RedirectResponse
    {
        if (!$id) {
            return redirect()->back();
        }

        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);

        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->has('delete_gallery')) {
            DB::table('areas_gallery')->whereIn('id', $request->get('delete_gallery'))->update(['deleted_at' => now()]);
            $requestData['gallery'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, Area::DIR, Area::SIZES);
        }

        DB::transaction(function () use ($requestData, $request, $id) {
            $municipility = $this->model->findOrFail($id);
            $municipility->update($requestData);

            $this->updateI18n($id, 'area_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $municipility->id,
                    'areas_gallery',
                    'area_id',
                    Area::DIR_GALLERY,
                    Area::SIZES_GALLERY
                );
            }

        });

        return redirect()->back()->with('success', 'Успешно редактирана ' . $this->singularPageTitle);
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
}