<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ParliamentaryGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;
use App\Http\Requests\Admin\AdminParliamentaryGroupRequest;
use App\Models\AffiliatedParliamentaryGroup;

class AdminParliamentaryGroupController extends AdminController
{
    protected $routes = 'parties';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->singularPageTitle = 'парламентарна група';
        $this->pluralPageTitle = 'парламентарни групи';
        
        $this->i18nTable = 'parliamentary_group_i18n';
        
        $this->model = new ParliamentaryGroup();
        
        $this->basicBreadcrumbs = [
            ['text' => 'Списък парламентарни групи', 'url' => route($this->routes . '.index')],
        ];
    }

    public function index(Request $request)
    {
        $parliamentaryGroups = $this->model->getAdminAll($request);
        
        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'name' => 'Име',
            'logo' => 'Снимка',
            'member_count' => 'Брой членове',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        
        $dataTable->setSkipSortableIds([2]);
        $dataTable->setRows($parliamentaryGroups, [
            'name' => function ($parliamentaryGroup) {
                return $parliamentaryGroup->i18n->name;
            },
            'logo' => function ($parliamentaryGroup) {
                return '<img src="' . $parliamentaryGroup->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'member_count' => function ($parliamentaryGroup) {
                return $parliamentaryGroup->seats_in_parliament;
            },
            'active' => function ($parliamentaryGroup) {
                return $parliamentaryGroup->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);
        
        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    /**
     * Create a new parliamentary group.
     *
     * @return Factory|View
     */
    public function create()
    {
        /* breadcrumbs */
        $title = 'Добавяне на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        $affiliatedParties = ParliamentaryGroup::getForSelectAdmin();

        return view('admin.partials._form_create_custom')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('affiliatedParties', $affiliatedParties)
            ->with('selectedAffiliatedParties', [])
            ->with('pageTitle', $title);
    }

    public function store(AdminParliamentaryGroupRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;
        
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['founding_date'] = $requestData['founding_date'] ? date('Y-m-d H:i:s', strtotime($requestData['founding_date'])) : null;
        // $requestData['social_media_links'] = json_encode($requestData['social_media_links']);
        
        DB::transaction(function () use ($requestData, $request) {
            $parliamentaryGroup = $this->model->create($requestData);
            $this->insertI18n($parliamentaryGroup->id, 'parliamentary_group_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $parliamentaryGroup->id, ParliamentaryGroup::DIR, ParliamentaryGroup::SIZES);
                DB::table('parliamentary_group')->where('id', $parliamentaryGroup->id)->update(['logo' => $logo]);
            }

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $parliamentaryGroup->id,
                    'parliamentary_group_gallery',
                    'parliamentary_group_id',
                    ParliamentaryGroup::DIR_GALLERY,
                    ParliamentaryGroup::SIZES_GALLERY
                );
            }

            if ($request->has('related_parties')) {
                $this->addRelatedIds($request->get('related_parties'), $parliamentaryGroup->id);
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
        $parliamentaryGroup = $this->model::findOrFail($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        $affiliatedParties = ParliamentaryGroup::getForSelectAdmin($id);
        $selectedAffiliatedParties = (new AffiliatedParliamentaryGroup)->getRelatedAssoc($id);

        return view('admin.partials._form_edit_custom')
            ->with('object', $parliamentaryGroup)
            ->with('dir', $parliamentaryGroup->getDir())
            ->with('size', ParliamentaryGroup::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('affiliatedParties', $affiliatedParties)
            ->with('selectedAffiliatedParties', $selectedAffiliatedParties ?? [])
            ->with('pageTitle', $title);
    }

    /**
     * Update a parliamentary group.
     *
     * @param AdminParliamentaryGroupRequest $request The request object.
     * @param int $id The ID of the parliamentary group.
     * @return RedirectResponse The redirect response.
     */
    public function update(AdminParliamentaryGroupRequest $request, int $id): RedirectResponse
    {
        if (!$id) {
            return redirect()->back();
        }

        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['founding_date'] = $requestData['founding_date'] ? date('Y-m-d H:i:s', strtotime($requestData['founding_date'])) : null;

        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->has('delete_gallery')) {
            DB::table('parliamentary_group_gallery')->whereIn('id', $request->get('delete_gallery'))->update(['deleted_at' => now()]);
            $requestData['gallery'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, ParliamentaryGroup::DIR, ParliamentaryGroup::SIZES);
        }

        DB::transaction(function () use ($requestData, $request, $id) {
            $parliamentaryGroup = $this->model->findOrFail($id);
            $parliamentaryGroup->update($requestData);

            $this->updateI18n($id, 'parliamentary_group_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $parliamentaryGroup->id,
                    'parliamentary_group_gallery',
                    'parliamentary_group_id',
                    ParliamentaryGroup::DIR_GALLERY,
                    ParliamentaryGroup::SIZES_GALLERY
                );
            }

            if ($request->has('related_parties')) {
                $this->addRelatedIds($request->get('related_parties'), $id);
            } else {
                AffiliatedParliamentaryGroup::where('parliamentary_group_id', $id)->delete();
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

    /**
     * Add related IDs to the affiliated parliamentary group.
     *
     * @param array $affiliatedPartyId The array of affiliated party IDs.
     * @param int $parliamentaryGroupId The ID of the parliamentary group.
     * @return void
     */
    public function addRelatedIds(array $affiliatedPartyId, int $parliamentaryGroupId)
    {
        AffiliatedParliamentaryGroup::where('parliamentary_group_id', $parliamentaryGroupId)->delete();

        foreach ($affiliatedPartyId as $relatedId) {
            AffiliatedParliamentaryGroup::insert([
                'parliamentary_group_id' => $parliamentaryGroupId,
                'affiliated_party_id' => $relatedId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}