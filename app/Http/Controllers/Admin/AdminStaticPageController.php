<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\StaticPage;
use App\Models\Page;
use App\Http\Requests\Admin\AdminPageRequest;
use App\Http\Controllers\Admin\AdminDataTable;
use App\Helpers\Helper;

class AdminStaticPageController extends AdminController
{
    protected $routes = 'pages';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'страница';
        $this->pluralPageTitle = 'страници';

        $this->i18nTable = 'static_pages_i18n';

        $this->model = new StaticPage();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък страници', 'url' => route($this->routes . '.index')],
        ];
    }

    public function index(Request $request)
    {
        $podcasts = $this->model->getAdmin($request);

        $dataTable = new AdminDataTable();
        $dataTable->setPaginator($podcasts);
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'title' => 'Заглавие',
            'slug' => 'Seo URL',
            'active' => 'Активна',
            'views' => 'Прегледи',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setRows($podcasts, [
            'title' => function ($podcast) {
                return $podcast->i18n->title;
            },
            'slug',
            'active' => function ($podcast) {
                return $podcast->active ? 'Да' : 'Не';
            },
            'views',
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

        return view('admin.partials._form_create')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('pageTitle', $title);
    }

    public function store(AdminPageRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['title']);

        DB::transaction(function () use ($requestData, $request) {
            $page = $this->model->create($requestData);
            $this->insertI18n($page->id, 'static_page_id', $this->i18nTable, $requestData['i18n']);
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавенa ' . $this->singularPageTitle);
    }

    public function edit(int $id)
    {
        $podcast = $this->model->findOrFail($id);
        if (!$podcast) {
            return redirect()->route($this->routes . '.index');
        }

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('pageTitle', $title)
            ->with('object', $podcast);
    }

    public function update(AdminPageRequest $request, int $id)
    {
        $page = $this->model->findOrFail($id);
        if (!$page) {
            return redirect()->route($this->routes . '.index');
        }

        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['title']);

        DB::transaction(function () use ($requestData, $page, $request, $id) {
            $page->update($requestData);
            $this->updateI18n($id, 'static_page_id', $this->i18nTable, $requestData['i18n']);
        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно редактиран ' . $this->singularPageTitle);
    }

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
