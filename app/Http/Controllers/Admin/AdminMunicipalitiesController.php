<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Helpers\Helper;
use App\Models\CustomButton;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Admin\AdminDataTable;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;
use App\Http\Requests\Admin\AdminMunicipalitiesRequest;
use App\Models\CustomButtonGallery;

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

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $municipilities = $this->model->getAdminAll($request);

        $dataTable = new AdminDataTable();
        $dataTable->setPaginator($municipilities);
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на община',
            'logo' => 'Снимка',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
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

        $areas = Area::getAreasForSelectAdmin();

        return view('admin.partials._form_create_custom')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('selectedArea', '')
            ->with('areas', $areas)
            ->with('customButtons', [])
            ->with('pageTitle', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminMunicipalitiesRequest $request The request object.
     * @return RedirectResponse The redirect response.
     */
    public function store(AdminMunicipalitiesRequest $request)
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

            // Save custom buttons
            if (isset($request->customButtons)) {
                foreach ($request->customButtons as $field) {
                    $customButton = new CustomButton($field);
                    $customButton->buttonable()->associate($municipility);
                    $customButton->active = isset($field['active']) ? 1 : 0; // Set default value for active field
                    $customButton->save();

                    // Save logo
                    if (isset($field['logo'])) {
                         $logo = $this->uploadImage($field['logo'], $customButton->id, CustomButton::DIR, CustomButton::SIZES);
                        DB::table('custom_buttons')->where('id', $customButton->id)->update(['logo' => $logo]);
                    }

                    if (isset($field['gallery'])) {
                         $this->uploadGallery(
                            $field['gallery'],
                            $customButton->id,
                            'custom_buttons_gallery',
                            'custom_button_id',
                            CustomButton::DIR_GALLERY,
                            CustomButton::SIZES_GALLERY
                        );
                    }
                }
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
        $municipility = $this->model::findOrFail($id);
        $areas = Area::getAreasForSelectAdmin();
        $selectedArea = $this->model->getRelatedArea($id);


        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $municipility)
            ->with('dir', $municipility->getDir())
            ->with('size', Municipality::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('selectedArea', $selectedArea)
            ->with('areas', $areas)
            ->with('customButtons', $municipility->customButtons)
            ->with('pageTitle', $title);
    }

    /**
     * Update a municipality.
     *
     * @param AdminMunicipalitiesRequest $request The request object.
     * @param int $id The ID of the municipality to update.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminMunicipalitiesRequest $request, int $id): RedirectResponse
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
            DB::table('municipalities_gallery')->whereIn('id', $request->get('delete_gallery'))->update(['deleted_at' => now()]);
            $requestData['gallery'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, Municipality::DIR, Municipality::SIZES);
        }

        DB::transaction(function () use ($requestData, $request, $id) {
            $municipility = $this->model->findOrFail($id);
            $municipility->update($requestData);

            $this->updateI18n($id, 'municipality_id', $this->i18nTable, $requestData['i18n']);

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

            // Ensure customButtons key is present
            if (!isset($requestData['customButtons'])) {
                $requestData['customButtons'] = [];
            }

            // Ensure each custom button has name and slug keys
            foreach ($requestData['customButtons'] as $key => &$button) {
                if (!isset($button['name']) || !isset($button['slug'])) {
                    unset($requestData['customButtons'][$key]);
                }
            }

            // Update custom buttons
            if (isset($requestData['customButtons'])) {
                $existingButtonIds = array_filter(array_column($requestData['customButtons'], 'id'));
                $buttonsToDelete = CustomButton::where('buttonable_id', $id)
                    ->whereNotIn('id', $existingButtonIds)
                    ->get();

                foreach ($buttonsToDelete as $button) {
                    // Delete associated gallery images
                    CustomButtonGallery::where('custom_button_id', $button->id)->delete();
                    $button->delete();
                }

                foreach ($requestData['customButtons'] as $field) {
                    $field['active'] = isset($field['active']) ? 1 : 0; // Set default value for active field

                    $customButton = isset($field['id']) ? CustomButton::find($field['id']) : new CustomButton();
                    $customButton->fill($field);
                    $customButton->buttonable()->associate($municipility);

                    // Check if there are changes before saving
                    if ($customButton->isDirty() || isset($field['gallery'])) {
                        $customButton->save();

                        // Save logo
                        if (isset($field['logo'])) {
                            $logo = $this->uploadImage($field['logo'], $customButton->id, CustomButton::DIR, CustomButton::SIZES);
                            DB::table('custom_buttons')->where('id', $customButton->id)->update(['logo' => $logo]);
                        }

                        if (isset($field['gallery'])) {
                            $this->uploadGallery(
                                $field['gallery'],
                                $customButton->id,
                                'custom_buttons_gallery',
                                'custom_button_id',
                                CustomButton::DIR_GALLERY,
                                CustomButton::SIZES_GALLERY
                            );
                        }
                    }

                    if ($request->has('delete_gallery_images') && $request->get('delete_gallery_images')) {
                        $deleteGalleryImages = explode(',', $request->get('delete_gallery_images'));
                        CustomButtonGallery::where(
                            'custom_button_id',
                            $customButton->id
                        )->whereIn('id', $deleteGalleryImages)->delete();
                    }
                }
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