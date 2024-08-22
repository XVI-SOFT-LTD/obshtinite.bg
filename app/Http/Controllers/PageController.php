<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;

class PageController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new StaticPage();
    }

    /* public function contacts()
    {
    $this->breadcrumbs = [
    ['url' => route('contacts'), 'name' => __('common.pages.contacts')],
    ];

    $pageTitle = __('common.pages.contacts');

    return view('pages.contact')
    ->with('breadcrumbs', $this->breadcrumbs)
    ->with('h1', $pageTitle)
    ->with('pageTitle', $pageTitle)
    ;
    }

    public function about()
    {

    $this->breadcrumbs = [
    ['url' => route('about'), 'name' => __('common.pages.about')],
    ];

    $pageTitle = __('common.pages.about');

    return view('pages.about')
    ->with('breadcrumbs', $this->breadcrumbs)
    ->with('h1', $pageTitle)
    ->with('pageTitle', $pageTitle)
    ;
    } */

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
}
