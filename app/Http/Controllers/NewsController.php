<?php

declare (strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\News;
use App\Models\Category;
use App\Helpers\Helper;

class NewsController extends Controller
{
    private $model;
    private $categories;

    public function __construct()
    {
        parent::__construct();

        $this->model = new News();

        $this->categories = new Category();

        /* $this->h1 = __('common.books.list_of_books');

    $this->breadcrumbs = [
    ['url' => route('news.index'), 'name' => __('common.books.list_of_books')],
    ]; */
    }

    public function showCategory(string $slug)
    {
        if (!$slug) {
            return redirect()->route('homepage');
        }

        $category = $this->categories->where('slug', $slug)->firstOrFail();
        if (!$category) {
            return redirect()->route('homepage');
        }

        $news = $this->model->getNewsByCategoryId($category->id, 12);

        $this->h1 = $category->i18n->name;
        $this->breadcrumbs[] = ['name' => $category->i18n->name];

        return view('news.category')
            ->with('news', $news)
            ->with('category', $category)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('activeCategory', $category->id)
        ;
    }

    public function show(int $id, string $slug)
    {
        $news = $this->model->with([
            #'authors',
            'categories',
            'i18n',
            'gallery',
            'related',
        ])
            ->where('id', $id)
            ->firstOrFail();

        $this->breadcrumbs[] = ['name' => $news->i18n->title];

        $news->increment('views');
        $news->increment('views_day');
        $news->increment('views_week');
        $news->increment('views_month');
        $news->increment('views_year');

        /* $related = $news->related->where('active', 1)->where('available', 1);
        if ($news->related->isEmpty()) {
        $related = $this->model->moreFromCategories($news, 12);
        } */

        return view('news.show')
            ->with('news', $news)
            ->with('previousNews', $news->previous())
            ->with('nextNews', $news->next())
            #->with('related', $related)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('customClasses', true)
        ;
    }

    public function list()
    {
        $news = $this->model->with([
            'i18n',
        ])
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6);
        
        return $news;
    }
}