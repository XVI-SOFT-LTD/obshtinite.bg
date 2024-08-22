<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Language;
use App\Http\Traits\I18n;
use App\Http\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminDataTable;

class AdminController extends Controller
{
    use FileUploadTrait, I18n;

    public $singularPageTitle;
    public $pluralPageTitle;
    public $basicBreadcrumbs = [];

    protected $model;
    protected $languages;
    protected $routes;
    protected $i18nTable;

    public function __construct()
    {
        $this->routes = AdminDataTable::NAMESPACE . $this->routes;

        $this->languages = Language::getLanguagesForAdmin();
        View::share('languages', $this->languages);

        View::share('routes', $this->routes ?? '');

    }

    public function index(Request $request)
    {
        return view('admin.dashboard')
            ->with('pageTitle', $this->pluralPageTitle);
    }

    public function insertI18n(int $foreignId, string $foreignName, string $table, array $i18n)
    {
        if (empty($i18n)) {
            return;
        }

        $insertI18n = [];
        foreach ($this->languages as $lang) {
            $insertI18n[$lang->id][$foreignName] = $foreignId;
            $insertI18n[$lang->id]['language_id'] = $lang->id;
            $insertI18n[$lang->id]['created_at'] = date('Y-m-d H:i:s');
            $insertI18n[$lang->id]['updated_at'] = date('Y-m-d H:i:s');

            if (isset($i18n[$lang->id]) && $i18n[$lang->id]) {
                foreach ($i18n[$lang->id] as $input => $value) {
                    $insertI18n[$lang->id][$input] = $value;
                }
            }
        }

        if (!empty($insertI18n)) {
            DB::table($table)->insert($insertI18n);
        }
    }

    protected function updateI18n(int $foreignId, string $foreignName, string $table, array $i18n)
    {
        if (empty($i18n)) {
            return;
        }

        foreach ($this->languages as $lang) {
            $where = [];
            $where[$foreignName] = $foreignId;
            $where['language_id'] = $lang->id;

            $updateI18n = [];
            if (isset($i18n[$lang->id]) && $i18n[$lang->id]) {
                foreach ($i18n[$lang->id] as $input => $value) {
                    $updateI18n[$input] = $value;
                }
            }

            DB::table($table)->where($where)->update($updateI18n);
        }
    }
}
