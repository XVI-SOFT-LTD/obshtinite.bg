<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Author;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\NewsAuthor;
use App\Models\NewsRelated;
use App\Models\Municipality;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Helpers\DropDownHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\AdminNewsRequest;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DynamicAdminDataTable;

class AdminNewsController extends AdminController
{
    protected $routes = 'news';
    protected array $newsStatuses = [];

    public function __construct()
    {
        parent::__construct();

        $this->singularPageTitle = 'новина';
        $this->pluralPageTitle = 'новини';

        $this->i18nTable = 'news_i18n';

        $this->model = new News();

        $this->basicBreadcrumbs = [
            ['text' => 'Списък новини', 'url' => route($this->routes . '.index')],
        ];

        $this->newsStatuses = DropDownHelper::getNewsStatuses();
    }

    public function index(Request $request)
    {
        $news = $this->model->getAdminAll($request);

        $dataTable = new DynamicAdminDataTable();
        $dataTable->setRoute($this->routes);
        $dataTable->setColumns([
            'fullname' => 'Име на новина',
            'logo' => 'Снимка',
            'Дата на публикуване',
            'authors' => 'Автори',
            'municipality' => 'Община',
            'active' => 'Активна',
            'created_at' => 'Създадена на',
            'updated_at' => 'Променена на',
        ]);
        $dataTable->setSkipSortableIds([2]);
        $dataTable->setRows($news, [
            'fullname' => function ($news) {
                return $news->i18n->title;
            },
            'logo' => function ($news) {
                return '<img src="' . $news->getLogo() . '" class="img-thumbnail" style="max-height: 40px;">';
            },
            'publish_date' => function ($news) {
                return $news->publish_date ? date('d.m.Y H:i:s', strtotime($news->publish_date)) : '';
            },
            'authors' => function ($news) {
                return Helper::getNewsAuthorsNamesAdmin($news);
            },
            'municipality' => function ($news) {
                return $news->municipality->i18n->name;
            },
            'active' => function ($news) {
                return $news->active ? 'Да' : 'Не';
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

        $categories = Category::getCategoriesAdmin();
        $authors = Author::getAuthorsForSelectAdmin();
        $relatedNews = News::getForSelectAdmin();
        $municipalities = Municipality::getMunicipalitiesForSelectAdmin();

        return view('admin.partials._form_create_custom')
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('categories', $categories)
            ->with('authors', $authors)
            ->with('relatedNews', $relatedNews)
            ->with('municipality', $municipalities)
            ->with('selectedCats', [])
            ->with('selectedAuthors', [])
            ->with('selectedRelatedNews', [])
            ->with('selectedMunicipality', [])
            ->with('newsStatuses', $this->newsStatuses)
            ->with('pageTitle', $title);
    }

    public function store(AdminNewsRequest $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth()->user()->id;
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['title']);
        $requestData['publish_date'] = $requestData['publish_date'] ? date('Y-m-d H:i:s', strtotime($requestData['publish_date'])) : null;

        DB::transaction(function () use ($requestData, $request) {
            $news = $this->model->create($requestData);
            $this->insertI18n($news->id, 'news_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('logo')) {
                $logo = $this->uploadImage($request->file('logo'), $news->id, News::DIR, News::SIZES);
                DB::table('news')->where('id', $news->id)->update(['logo' => $logo]);
            }

            if ($request->has('categories')) {
                $this->addCatsIds($request->get('categories'), $news->id);
            }

            if ($request->has('authors')) {
                $this->addAuthorsIds($request->get('authors'), $news->id);
            }

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $news->id,
                    'news_gallery',
                    'news_id',
                    News::DIR_GALLERY,
                    News::SIZES_GALLERY
                );
            }

            if ($request->has('related_news')) {
                $this->addRelatedIds($request->get('related_news'), $news->id);
            }

        });

        return redirect()->route($this->routes . '.index')->with('success', 'Успешно добавена ' . $this->singularPageTitle);
    }

    public function edit(int $id)
    {
        $news = $this->model::findOrFail($id);

        $categories = Category::getCategoriesAdmin();
        $authors = Author::getAuthorsForSelectAdmin();
        $relatedNews = News::getForSelectAdmin($id);
        $municipalities = Municipality::getMunicipalitiesForSelectAdmin();

        $selectedCats = (new NewsCategory)->getCatsAssoc($id);
        $selectedAuthors = (new NewsAuthor)->getAuthorsAssoc($id);
        $selectedRelatedNews = (new NewsRelated)->getRelatedAssoc($id);
        $selectedMunicipality = $this->model->getRelatedMunicipality();

        /* breadcrumbs */
        $title = 'Редакция на ' . $this->singularPageTitle;
        $breadcrumbs = $this->basicBreadcrumbs;
        $breadcrumbs[] = ['text' => $title];

        return view('admin.partials._form_edit_custom')
            ->with('object', $news)
            ->with('dir', $news->getDir())
            ->with('size', News::MAIN_SIZE)
            ->with('routes', $this->routes)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('categories', $categories)
            ->with('authors', $authors)
            ->with('relatedNews', $relatedNews)
            ->with('municipalities', $municipalities)
            ->with('selectedCats', $selectedCats)
            ->with('selectedAuthors', $selectedAuthors)
            ->with('selectedRelatedNews', $selectedRelatedNews ?? [])
            ->with('selectedMunicipality', $selectedMunicipality)
            ->with('newsStatuses', $this->newsStatuses)
            ->with('authors', $authors)
            ->with('pageTitle', $title);
    }

    public function update(AdminNewsRequest $request, int $id)
    {
        if (!$id) {
            return redirect()->back();
        }

        $requestData = $request->all();
        $requestData['updated_by'] = auth()->user()->id;

        $requestData['slug'] = Helper::strSlug($requestData['i18n'][1]['title']);
        $requestData['publish_date'] = $requestData['publish_date'] ? date('Y-m-d H:i:s', strtotime($requestData['publish_date'])) : null;

        if ($request->has('delete_logo')) {
            $requestData['logo'] = null;
        }

        if ($request->has('delete_gallery')) {
            DB::table('news_gallery')->whereIn('id', $request->get('delete_gallery'))->update(['deleted_at' => now()]);
            $requestData['gallery'] = null;
        }

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $this->uploadImage($request->file('logo'), $id, News::DIR, News::SIZES);
        }

        DB::transaction(function () use ($requestData, $request, $id) {
            $news = $this->model->findOrFail($id);
            $news->update($requestData);

            $this->updateI18n($id, 'news_id', $this->i18nTable, $requestData['i18n']);

            if ($request->hasFile('gallery')) {
                $this->uploadGallery(
                    $request->file('gallery'),
                    $news->id,
                    'news_gallery',
                    'news_id',
                    News::DIR_GALLERY,
                    News::SIZES_GALLERY
                );
            }

            if ($request->has('categories')) {
                $this->addCatsIds($request->get('categories'), $id);
            }

            if ($request->has('authors')) {
                $this->addAuthorsIds($request->get('authors'), $id);
            }

            if ($request->has('related_news')) {
                $this->addRelatedIds($request->get('related_news'), $id);
            } else {
                NewsRelated::where('news_id', $id)->delete();
            }

        });

        return redirect()->back()->with('success', 'Успешно редактирана ' . $this->singularPageTitle);
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

    private function addCatsIds(array $categoryIds, int $newsId)
    {
        NewsCategory::where('news_id', $newsId)->delete();

        foreach ($categoryIds as $categoryId) {
            NewsCategory::create([
                'news_id' => $newsId,
                'category_id' => $categoryId,
            ]);
        }
    }

    public function addAuthorsIds(array $authorIds, int $newsId)
    {
        NewsAuthor::where('news_id', $newsId)->delete();

        foreach ($authorIds as $authorId) {
            NewsAuthor::insert([
                'news_id' => $newsId,
                'author_id' => $authorId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function addRelatedIds(array $relatedIds, int $newsId)
    {
        NewsRelated::where('news_id', $newsId)->delete();

        foreach ($relatedIds as $relatedId) {
            NewsRelated::insert([
                'news_id' => $newsId,
                'related_id' => $relatedId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}