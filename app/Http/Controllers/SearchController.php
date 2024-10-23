<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\News;
use App\Helpers\Helper;
use App\Models\Landmark;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Models\ParliamentaryGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    private Model $newsModel;
    private Model $parliamentaryGroupModel;
    private Model $landmarkModel;
    private Model $areaModel;
    private Model $municipalityModel;

    public function __construct()
    {
        $this->newsModel = new News();
        $this->parliamentaryGroupModel = new ParliamentaryGroup();
        $this->landmarkModel = new Landmark();
        $this->areaModel = new Area();
        $this->municipalityModel = new Municipality();
    }

    public function postSearch(Request $request)
    {
        // dd(123);
        $word = $request->get('word') ?? null;
        if (!$word) {
            throw ValidationException::withMessages(['message' => 'Не сте въвели дума за търсене.']);
        }

        Session::put('word', $word);

        return redirect()->route('search.get');
    }

    public function search(Request $request)
    {
        $word = Session::get('word') ?? [];

        if (empty($word)) {
            return Redirect::to('/');
        }

        $requestData = $request->all();
        $news = $this->newsModel->searchNews($word, 20);
        $parliamentaryGroups = $this->parliamentaryGroupModel->searchParliamentaryGroups($word, 20);
        $landmarks = $this->landmarkModel->searchLandmarks($word, 20);
        $areas = $this->areaModel->searchAreas($word, 20);
        $municipalities = $this->municipalityModel->searchMunicipalities($word, 20);
        $results = $news->merge($parliamentaryGroups)->merge($landmarks)->merge($areas)->merge($municipalities);

        $h1 = __('common.search.search_results', ['word' => $word]);

        return view('search.index')
            ->with('results', $results)
            ->with('h1', $h1)
            ->with('word', $word)
        ;
    }
}