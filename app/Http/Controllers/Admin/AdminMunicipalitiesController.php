<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\AdminMunicipalitiesRequest;

class AdminMunicipalitiesController extends AdminController
{
    protected $routes = 'municipalities';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'община';
        $this->pluralPageTitle = 'общини';

        $this->i18nTable = 'municipalities_i18n';

        $this->model = new Municipality();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък общини', 'url' => route($this->routes . '.index')],
        ];
    }

    public function index(Request $request)
    {
        $municipilities = $this->model->getAdminAll($request);

        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на община',
            'logo' => 'Снимка',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setSkipSortableIds([2]);
        $dataTable->setRows($municipilities, [
            'name' => function ($municipilities) {
                return $municipilities->i18n->name;
            },
            'logo' => function ($municipilities) {
                return '<img src="' . $municipilities->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'active' => function ($municipilities) {
                return $municipilities->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new municipality.
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

    public function store(AdminMunicipalitiesRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;
        $requestData['i18n'][1]['keywords'] = json_encode($requestData['i18n'][1]['keywords']);

        DB::transaction(function () use ($requestData, $request) {
            $municipility = $this->model->create($requestData);
            $this->insertI18n($municipility->id, 'municipality_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $municipility->id, Municipality::DIR, Municipality::SIZES);
                DB::table('municipalities')->where('id', $municipility->id)->update(['logo' => $logo]);
            }

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $municipility->id,
                    'municipalities_gallery',
                    'municipality_id',
                    Municipality::DIR_GALLERY,
                    Municipality::SIZES_GALLERY
                );
            }
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавена ' . $this->singularPageTitle);
    }

    /**
     * Edit a parliamentary group.
     *
     * @param int $id The ID of the parliamentary group to edit.
     * @return View The view for editing the parliamentary group.
     */
    public function edit(int $id): View
    {
        $municipility = $this->model::findOrFail($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $municipility)
            ->with('dir', $municipility->getDir())
            ->with('size', Municipality::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('pageTitle', $title);
    }
}