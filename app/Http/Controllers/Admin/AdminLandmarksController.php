<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Landmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\AdminController;
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

     public function index(Request $request)
    {
        $landmark = $this->model->getAdminAll($request);

        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на забележителността',
            'logo' => 'Снимка',
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
            'active' => function ($landmark) {
                return $landmark->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }


}