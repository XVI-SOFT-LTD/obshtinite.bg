<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\Admin\AuthorRequest;
use App\Http\Controllers\Admin\DynamicAdminDataTable;
use App\Helpers\Helper;

class AdminAuthorController extends AdminController
{
    protected $routes = 'authors';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'автор';
        $this->pluralPageTitle = 'автори';

        $this->i18nTable = 'authors_i18n';

        $this->model = new Author();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък автори', 'url' => route($this->routes . '.index')],
        ];
    }

    public function index(Request $request)
    {
        $authors = $this->model->getAuthorsAdminAll($request);

        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Имена на автора',
            'news_count' => 'Брой статии',
            'logo' => 'Снимка',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setSkipSortableIds([3]);
        $dataTable->setRows($authors, [
            'fullname' => function ($author) {
                return $author->i18n->fullname;
            },
            'news_count' => function ($author) {
                return $author->news_count;
            },
            'logo' => function ($author) {
                return '<img src="' . $author->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'active' => function ($author) {
                return $author->active ? 'Да' : 'Не';
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

        return view('admin.partials._form_create')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('pageTitle', $title);
    }

    public function store(AuthorRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['fullname']);

        DB::transaction(function () use ($requestData, $request) {
            $author = $this->model->create($requestData);
            $this->insertI18n($author->id, 'author_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $author->id, Author::DIR, Author::SIZES);
                DB::table('authors')->where('id', $author->id)->update(['logo' => $logo]);
            }
        });

        return redirect()->route($this->routes . '.index');
    }

    public function edit($id)
    {
        $author = $this->model::with(['news.i18n'])->withCount('news')->findOrFail($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit')
            ->with('object', $author)
            ->with('dir', $author->getDir())
            ->with('size', Author::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('pageTitle', $title);
    }

    public function update(AuthorRequest $request, $id)
    {
        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['fullname']);

        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, Author::DIR, Author::SIZES);
        }

        DB::transaction(function () use ($requestData, $id) {
            $author = $this->model->findOrFail($id);
            $author->update($requestData);

            $this->updateI18n($id, 'author_id', $this->i18nTable, $requestData['i18n']);
        });

        return redirect()->route($this->routes . '.index');
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
