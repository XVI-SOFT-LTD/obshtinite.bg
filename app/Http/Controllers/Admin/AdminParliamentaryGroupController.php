<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ParliamentaryGroup;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;
use App\Http\Requests\Admin\AdminParliamentaryGroupRequest;

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

    public function store(AdminParliamentaryGroupRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;
        
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);
        $requestData['founding_date'] = $requestData['founding_date'] ? date('Y-m-d H:i:s', strtotime($requestData['founding_date'])) : null;
        $requestData['social_media_links'] = json_encode($requestData['social_media_links']);
        
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

        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавена ' . $this->singularPageTitle);
    }
}