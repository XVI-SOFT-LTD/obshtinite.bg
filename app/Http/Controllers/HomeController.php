<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\News;

class HomeController extends Controller
{
    private Model $newsModel;

    public function __construct()
    {
        $this->newsModel = new News();
    }

    public function homepage()
    {
        $topNews = $this->newsModel->getTopNewsHomepage(3);

        $excludedIds = [];
        if ($topNews->count() > 0) {
            $excludedIds = $topNews->pluck('id')->toArray();
        }

        $news = $this->newsModel->getAllNewsHomepagePaging($excludedIds, 10);

        return view('homepage.homepage')
            ->with('topNews', $topNews)
            ->with('news', $news)
            ->with('homepage', true)
        ;
    }

    public function category()
    {
        return view('frontend.category');
    }

    public function video()
    {
        return view('frontend.single-video');
    }

    public function audio()
    {
        return view('frontend.single-audio');
    }

    public function gallery()
    {
        return view('frontend.single-gallery');
    }

    public function standard()
    {
        return view('frontend.single-standard');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
