<?php

namespace App\Http\Controllers;

use App\Models\Landmark;
use App\Models\Municipality;
use App\Models\News;
use App\Models\ParliamentaryGroup;
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
        $news = $this->newsModel->getHomepageNews(9);
        $municipalities = $this->municipalitiesModel->getAllMunicipalitiesHomepagePaging();

        $parties = $this->parliamentaryGroupModel->getAllParliamentaryGroupHomepagePaging();
        #$landmarks = $this->landmarkModel->getAllLandmarksHomepagePaging();

        return view('homepage.homepage')
            ->with('news', $news)
            ->with('municipalities', $municipalities)
            ->with('parties', $parties)
            #->with('landmarks', $landmarks)
        ;
    }
}
