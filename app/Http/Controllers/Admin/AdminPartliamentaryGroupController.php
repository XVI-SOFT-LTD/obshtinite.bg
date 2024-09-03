<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ParliamentaryGroup;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;

class AdminPartliamentaryGroupController extends AdminController
{
    protected $routes = 'parties';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->singularPageTitle = 'парламентарна група';
        $this->pluralPageTitle = 'парламентарни групи';
        
        $this->i18nTable = 'partliamentary_groups_i18n';
        
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

}