<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Helpers\Helper;
use App\Models\Landmark;

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


}