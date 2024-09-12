<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Landmark;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\AdminLandmarksRequest;
use App\Http\Controllers\Admin\DynamicAdminDataTable;

class AdminLandmarksController extends AdminController
{
    protected $routes = 'landmarks';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'забележителност';
        $this->pluralPageTitle = 'забележителности';

        $this->i18nTable = 'landmarks_i18n';

        $this->model = new Landmark();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък забележителност', 'url' => route($this->routes . '.index')],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request)
    {
        $landmark = $this->model->getAdminAll($request);

        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на забележителността',
            'logo' => 'Снимка',
            'minicipality' => 'Община',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setSkipSortableIds([2]);
        $dataTable->setRows($landmark, [
            'name' => function ($landmark) {
                return $landmark->i18n->name;
            },
            'logo' => function ($landmark) {
                return '<img src="' . $landmark->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'minicipality' => function ($landmark) {
                return $landmark->municipality->i18n->name;
            },
            'active' => function ($landmark) {
                return $landmark->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new landmark.
     *
     * @return Factory|View
     */
    public function create()
    {
        /* breadcrumbs */
        $title = 'Добавяне на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        $municipalities = Municipality::getMunicipalitiesForSelectAdmin();

        return view('admin.partials._form_create_custom')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('selectedMunicipalities', '')
            ->with('municipalities', $municipalities)
            ->with('pageTitle', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminLandmarksRequest $request
     * @return RedirectResponse
     */
    public function store(AdminLandmarksRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['municipality_id'] = (int) $requestData['municipality_id'];

        DB::transaction(function () use ($requestData, $request) {
            $landmark = $this->model->create($requestData);
            $this->insertI18n($landmark->id, 'landmark_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $landmark->id, Landmark::DIR, Landmark::SIZES);
                DB::table('landmarks')->where('id', $landmark->id)->update(['logo' => $logo]);
            }

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $landmark->id,
                    'landmarks_gallery',
                    'landmarks_id',
                    Landmark::DIR_GALLERY,
                    Landmark::SIZES_GALLERY
                );
            }
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавена ' . $this->singularPageTitle);
    }

    /**
     * Edit a municipality.
     *
     * @param int $id The ID of the municipality to edit.
     * @return View The view for editing the municipality.
     */
    public function edit(int $id): View
    {
        $landmark = $this->model::findOrFail($id);
        $municipalities = Municipality::getMunicipalitiesForSelectAdmin();
        $selectedMunicipality = $this->model->getRelatedMunicipality($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $landmark)
            ->with('dir', $landmark->getDir())
            ->with('size', Landmark::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('selectedMunicipalities', $selectedMunicipality)
            ->with('municipalities', $municipalities)
            ->with('pageTitle', $title);
    }

    /**
     * Update a landmark.
     *
     * @param AdminLandmarksRequest $request The request object.
     * @param int $id The ID of the landmark to update.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminLandmarksRequest $request, int $id): RedirectResponse
    {
        if (!$id) {
            return redirect()->back();
        }

        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['municipality_id'] = (int) $requestData['municipality_id'];
        
        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->has('delete_gallery')) {
            DB::table('landmarks_gallery')->whereIn('id', $request->get('delete_gallery'))->update(['deleted_at' => now()]);
            $requestData['gallery'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, Landmark::DIR, Landmark::SIZES);
        }

        DB::transaction(function () use ($requestData, $request, $id) {
            $landmark = $this->model->findOrFail($id);
            $landmark->update($requestData);

            $this->updateI18n($id, 'landmark_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $landmark->id,
                    'landmarks_gallery',
                    'landmark_id',
                    Landmark::DIR_GALLERY,
                    Landmark::SIZES_GALLERY
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