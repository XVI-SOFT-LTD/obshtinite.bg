<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Helpers\Helper;

class SearchController extends Controller
{
    private Model $newsModel;

    public function __construct()
    {
        $this->newsModel = new News();
    }

    public function postSearch(Request $request)
    {
        $word = $request->get('word') ?? null;
        if (!$word) {
            throw ValidationException::withMessages(['message' => 'Не сте въвели дума за търсене.']);
        }

        Session::put('word', $word);

        return redirect()->route('search');
    }

    public function search(Request $request)
    {
        $word = Session::get('word') ?? [];

        if (empty($word)) {
            return Redirect::to('/');
        }

        $requestData = $request->all();
        $news = $this->newsModel->searchNews($word, 20);

        $h1 = __('common.search.search_results', ['word' => $word]);

        $pageTitle = 'Търсене: ' . $word;

        return view('search.index')
            ->with('news', $news)
            ->with('h1', $h1)
            ->with('word', $word)
            ->with('pageTitle', $pageTitle)
        ;
    }
}
