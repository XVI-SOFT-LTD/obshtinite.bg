<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang = "en")
    {
        if ($lang == "bg") {
            $language = "bg";
        } else {
            $language = "en";
        }

        Session::put('locale', $language);
        App::setLocale($language);

        return redirect()->back();
    }
}