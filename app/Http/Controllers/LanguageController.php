<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function getTranslations($locale)
    {
        $path = resource_path("lang/{$locale}/navbar.json");

        if (!File::exists($path)) {
            return response()->json(['error' => 'Translations not found'], 404);
        }

        $translations = File::get($path);
        return response()->json(json_decode($translations, true));
    }
}