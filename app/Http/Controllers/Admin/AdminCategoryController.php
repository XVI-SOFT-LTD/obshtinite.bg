<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\DropDownHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Controllers\Admin\AdminDataTable;
use App\Http\Controllers\Admin\AdminController;

class AdminCategoryController extends AdminController
{
    protected $routes = 'categories';

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'категория';
        $this->pluralPageTitle = 'категории';

        $this->i18nTable = 'categories_i18n';

        $this->model = new Category();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък категории', 'url' => route($this->routes . '.index')],
        ];

    }

    public function index(Request $request, int $parentId = 0)
    {
        $categories = $this->model::withCount(['news'])->where('parent_id', $parentId)->orderBy('id', 'desc')->paginate(20);

        $dataTable = new AdminDataTable();
        $dataTable->setPaginator($categories);
        $dataTable->setRoute('categories');
        $dataTable->setColumns([
            'name' => 'Име',
            'book_count' => 'Брой статии',
            'parent_id' => 'Подкатегории',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setRows($categories, [
            'name' => function ($category) {
                return $category->i18n->name;
            },
            'book_count' => function ($category) {
                return $category->books_count;
            },
            'parent_id' => function ($category) {
                return '<a href="' . route($this->routes . '.index', $category->id ? $category->id : null) . '"><span class="glyphicon glyphicon-search"></span></a>';
            },
            'active' => function ($category) {
                #return '<input type="checkbox" class="js-switch disabled" data-id="' . $category->id . '" ' . ($category->active ? 'checked' : '') . '>';
                return $category->active ? 'Да' : 'Не';
            },
            'created_at',
            'updated_at',
        ]);

        if ($parentId) {
            $category = $this->model::with('i18n')->find($parentId);
            $this->pluralPageTitle = 'Подкатегории към <b>' . $category->i18n->name . "</b>";

            $this->basicBreadcrumbs[] = ['text' => strip_tags($this->pluralPageTitle)];
        }

        $dataTable->setBreadcrumbs($this->basicBreadcrumbs);

        return $dataTable->render($this->pluralPageTitle);
    }

    public function create()
    {
        $categoryOptions = DropDownHelper::getCategories();

        /* breadcrumbs */
        $title = 'Добавяне на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_create')
            ->with('categoryOptions', $categoryOptions)
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('pageTitle', $title);
    }

    public function store(CategoryRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);

        $category = DB::transaction(function () use ($requestData) {
            $category = $this->model->create($requestData);
            $this->insertI18n($category->id, 'category_id', $this->i18nTable, $requestData['i18n']);

            return $category;
        });

        return redirect()->route($this->routes . '.index', ['parentId' => $category->parent_id]);
    }

    public function edit(int $id, int $parentId = 0)
    {
        $categoryOptions = DropDownHelper::getCategories();

        $category = $this->model->withCount('news')->findOrFail($id);

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        if ($category->parent_id) {
            $parentCategory = $this->model::with('i18n')->find($category->parent_id);
            $breadcrumbs[] = ['text' => 'Категории към <b>' . $parentCategory->i18n->name . "</b>", 'url' => route($this->routes . '.index', $category->parent_id)];
        }
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit')
            ->with('object', $category)
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('categoryOptions', $categoryOptions)
            ->with('pageTitle', $title);
    }

    public function update(CategoryRequest $request, int $id)
    {
        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;
        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['name']);

        $category = DB::transaction(function () use ($requestData, $id) {
            $category = $this->model->findOrFail($id);
            $category->update($requestData);

            $this->updateI18n($id, 'category_id', $this->i18nTable, $requestData['i18n']);

            return $category;
        });

        return redirect()->route($this->routes . '.index', ['parentId' => $category->parent_id]);
    }

    public function destroy($id)
    {
        try {
            $record = $this->model::findOrFail($id);
            $record->delete();

            return response()->json(['status' => 'success', 'message' => 'Record successfully deleted.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'There was an error while deleting the record.']);
        }
    }

}