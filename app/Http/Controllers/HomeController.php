<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Landmark;
use App\Models\Municipality;
use App\Models\ParliamentaryGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class HomeController extends Controller
{
    private Model $newsModel;
    private Model $parliamentaryGroupModel;
    private Model $municipalitiesModel;
    private Model $landmarkModel;

    public function __construct()
    {
        $this->newsModel = new News();
        $this->parliamentaryGroupModel = new ParliamentaryGroup();
        $this->municipalitiesModel = new Municipality();
        $this->landmarkModel = new Landmark();
    }

    public function homepage()
    {
        $topNews = $this->newsModel->getTopNewsHomepage(3);

        $excludedIds = [];
        if ($topNews->count() > 0) {
            $excludedIds = $topNews->pluck('id')->toArray();
        }

        $news = $this->newsModel->getAllNewsHomepagePaging($excludedIds, 10);
        $parliamentaryGroups = $this->parliamentaryGroupModel->getAllParliamentaryGroupHomepagePaging();
        $municipalities = $this->municipalitiesModel->getAllMunicipalitiesHomepagePaging();
        $landmarks = $this->landmarkModel->getAllLandmarksHomepagePaging();

        return view('homepage.homepage')
            ->with('topNews', $topNews)
            ->with('news', $news)
            ->with('parliamentaryGroups', $parliamentaryGroups)
            ->with('municipalities', $municipalities)
            ->with('landmarks', $landmarks)
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