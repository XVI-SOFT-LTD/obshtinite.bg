<?php

namespace App\Http\Controllers\Admin;

use App\Models\MegaBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\AdminMegaBannersRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminMegaBannersController extends AdminController
{
    protected $routes = 'mega-banners';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'мега банер';
        $this->pluralPageTitle = 'мега банери';

        $this->i18nTable = 'mega_banners_i18n';

        $this->model = new MegaBanner();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък мега банери', 'url' => route($this->routes . '.index')],
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
        $megaBanners = $this->model->getAdminAll($request);

        $dataTable = new AdminDataTable();
        $dataTable->setPaginator($megaBanners);
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на Банера',
            'logo' => 'Снимка',
            'active' => 'Активен',
            'created_at' => 'Създаден на',
            'updated_at' => 'Променен на',
        ]);
        $dataTable->setRows($megaBanners, [
            'name' => function ($megaBanners) {
                return $megaBanners->i18n->name;
            },
            'logo' => function ($megaBanners) {
                return '<img src="' . $megaBanners->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'active' => function ($megaBanners) {
                return $megaBanners->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new mega banner.
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
     * @param AdminMegaBannersRequest $request The request object.
     * @return RedirectResponse The redirect response.
     */
    public function store(AdminMegaBannersRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;
        
        DB::transaction(function () use ($requestData, $request) {
            $megabanner = $this->model->create($requestData);
            $this->insertI18n($megabanner->id, 'mega_banner_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $megabanner->id, MegaBanner::DIR, MegaBanner::SIZES);
                DB::table('mega_banners')->where('id', $megabanner->id)->update(['logo' => $logo]);
            }
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавена ' . $this->singularPageTitle);
    }

     /**
     * Edit a mega banner.
     *
     * @param int $id The ID of the mega banner to edit.
     * @return View The view for editing the mega banner.
     */
    public function edit(int $id): View
    {
        $megabanner = $this->model::findOrFail($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $megabanner)
            ->with('dir', $megabanner->getDir())
            ->with('size', MegaBanner::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('pageTitle', $title);
    }

    /**
     * Update a mega banner.
     *
     * @param AdminMegaBannersRequest $request The request object.
     * @param int $id The ID of the municipality to update.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminMegaBannersRequest $request, int $id): RedirectResponse
    {
        if (!$id) {
            return redirect()->back();
        }

        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;

        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, MegaBanner::DIR, MegaBanner::SIZES);
        }

        DB::transaction(function () use ($requestData, $request, $id) {
            $megabanner = $this->model->findOrFail($id);
            $megabanner->update($requestData);

            $this->updateI18n($id, 'mega_banner_id', $this->i18nTable, $requestData['i18n']);
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