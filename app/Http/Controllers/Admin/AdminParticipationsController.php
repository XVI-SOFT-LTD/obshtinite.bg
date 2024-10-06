<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Participation;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;
use App\Http\Requests\Admin\AdminParticipationsRequest;
use App\Models\ParticipationsCategories;

class AdminParticipationsController extends AdminController
{
    protected $routes = 'participations';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'участие';
        $this->pluralPageTitle = 'участия';

        $this->i18nTable = 'participations_i18n';

        $this->model = new Participation();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък участия', 'url' => route($this->routes . '.index')],
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
        $participations = $this->model->getAdminAll($request);

        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на участието',
            'logo' => 'Снимка',
            'area' => 'Област',
            'category' => 'Категория',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        
        $dataTable->setSkipSortableIds([2]);
    
        $dataTable->setRows($participations, [
            'name' => function ($participations) {
                return $participations->i18n->name;
            },
            'logo' => function ($participations) {
                return '<img src="' . $participations->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'area' => function ($participations) {
                return $participations->area->i18n->name;
            },
            'category' => function ($participations) {
                $categoryNames = [];
                foreach ($participations->categories as $category) {
                    $categoryNames[] = $category->i18n->name;
                }
                return implode(', ', $categoryNames);
            },
            'active' => function ($participations) {
                return $participations->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new participation.
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
            ->with('selectedArea', '')
            ->with('selectedCategories', [])
            ->with('areas', $areas)
            ->with('categories', $categories)
            ->with('pageTitle', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminParticipationsRequest $request The request object.
     * @return RedirectResponse The redirect response.
     */
    public function store(AdminParticipationsRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;
        $requestData['i18n'][1]['keywords'] = json_encode($requestData['i18n'][1]['keywords']);
        $requestData['area_id'] = (int) $requestData['area_id'];
        
        DB::transaction(function () use ($requestData, $request) {
            $participation = $this->model->create($requestData);
            $this->insertI18n($participation->id, 'participation_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $participation->id, Participation::DIR, Participation::SIZES);
                DB::table('participations')->where('id', $participation->id)->update(['logo' => $logo]);
            }

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $participation->id,
                    'participations_gallery',
                    'participation_id',
                    Participation::DIR_GALLERY,
                    Participation::SIZES_GALLERY
                );
            }

            if ($request->has('categories')) {
                $this->addRelatedCategoriesIds($request->get('categories'), $participation->id);
            }
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавено ' . $this->singularPageTitle);
    }

    /**
     * Edit a municipality.
     *
     * @param int $id The ID of the municipality to edit.
     * @return View The view for editing the municipality.
     */
    public function edit(int $id): View
    {
        $participation = $this->model::findOrFail($id);
        $areas = Area::getAreasForSelectAdmin();
        $catogories = Category::getCategoriesAdmin();
        $selectedArea = $this->model->getRelatedArea();
        $selectedCategories = (new ParticipationsCategories())->getRelatedAssoc($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $participation)
            ->with('dir', $participation->getDir())
            ->with('size', Participation::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('selectedArea', $selectedArea)
            ->with('areas', $areas)
            ->with('selectedCategories', $selectedCategories)
            ->with('catogories', $catogories)
            ->with('pageTitle', $title);
    }

    /**
     * Update a participation.
     *
     * @param AdminParticipationsRequest $request The request object.
     * @param int $id The ID of the participation to update.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminParticipationsRequest $request, int $id): RedirectResponse
    {
        if (!$id) {
            return redirect()->back();
        }

        
        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['active_from'] = $requestData['active_from'] ? date('Y-m-d H:i:s', strtotime($requestData['active_from'])) : null;
        $requestData['active_to'] = $requestData['active_to'] ? date('Y-m-d H:i:s', strtotime($requestData['active_to'])) : null;
        $requestData['i18n'][1]['keywords'] = json_encode($requestData['i18n'][1]['keywords']);
        $requestData['area_id'] = (int) $requestData['area_id'];
        
        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->has('delete_gallery')) {
            DB::table('participations_gallery')->whereIn('id', $request->get('delete_gallery'))->update(['deleted_at' => now()]);
            $requestData['gallery'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, Participation::DIR, Participation::SIZES);
        }
        
        DB::transaction(function () use ($requestData, $request, $id) {
            $participation = $this->model->findOrFail($id);
            $participation->update($requestData);

            $this->updateI18n($id, 'participation_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $participation->id,
                    'participations_gallery',
                    'participation_id',
                    Participation::DIR_GALLERY,
                    Participation::SIZES_GALLERY
                );
            }

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
     * Add related category IDs to a participation.
     *
     * This method first deletes any existing category associations for the given participation ID.
     * Then, it inserts new records for each category ID provided in the $categoriesIds array.
     *
     * @param array $categoriesIds An array of category IDs to be associated with the participation.
     * @param int $participationId The ID of the participation to which the categories will be associated.
     * @return void
     */
    public function addRelatedCategoriesIds(array $categoriesIds, int $participationId): void
    {
        ParticipationsCategories::where('participation_id', $participationId)->delete();

        foreach ($categoriesIds as $categoryId) {
            ParticipationsCategories::insert([
                'participation_id' => $participationId,
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}