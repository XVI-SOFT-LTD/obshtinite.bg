<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\News;
use App\Models\Landmark;
use App\Models\StaticPage;
use App\Models\Municipality;
use App\Models\ParliamentaryGroup;

class PageController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new StaticPage();
    }

    public function contacts()
    {
        $page = $this->model->where('slug', 'kontakti')->first();
        if (!$page) {
            return redirect()->route('homepage');
        }

        $this->breadcrumbs = [
            ['url' => route('page.show', $page->slug), 'name' => $page->i18n->title],
        ];

        $pageTitle = $page->i18n->title;

        return view('pages.contacts')
            ->with('page', $page)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('h1', $pageTitle)
            ->with('pageTitle', $pageTitle)
        ;
    }

    public function show(string $slug)
    {
        if (!$slug) {
            return redirect()->route('homepage');
        }

        $page = $this->model->where('slug', $slug)->first();
        if (!$page) {
            return redirect()->route('homepage');
        }

        $this->breadcrumbs = [
            ['url' => route('page.show', $page->slug), 'name' => $page->i18n->title],
        ];

        $pageTitle = $page->i18n->title;

        return view('pages.show')
            ->with('page', $page)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('h1', $pageTitle)
            ->with('pageTitle', $pageTitle)
        ;
    }


    public function listCategory(string $categoryName) {
        $routeName = '';
         switch ($categoryName) {
            // case 'landmarks':
            //     $models = Landmark::all();
            //     $routeName = 'landmark.show';
            //     break;
            case 'municipalities':
                $models = Municipality::paginate(12);
                $routeName = 'municipality.show';
                break;
            case 'parliamentaryGroups':
                $models = ParliamentaryGroup::paginate(12);
                $routeName = 'parliamentaryGroup.show';
                break;
            case 'areas':
                $models = Area::paginate(12);
                $routeName = 'area.show';
                break;
            default:
                $routeName = '/';
                abort(404, 'Category not found');
        }

        return view('pages.category_listing')
            ->with('models', $models)
            ->with('routeName', $routeName)
            ->with('categoryName', $categoryName);
    }
}