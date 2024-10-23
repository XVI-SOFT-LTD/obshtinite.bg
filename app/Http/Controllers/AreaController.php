<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    private $areaModel;
        
    public function __construct()
    {
        $this->areaModel = new Area();
    }

    public function show(string $slug)
    {
        $area = $this->areaModel->where('slug', $slug)->with(['municipality.landmarks'])->firstOrFail();

        return view('pages.area', compact('area'));
    }

    public function listAllAreas()
    {
          // Извличаме всички активни области
        $areas = $this->areaModel->where('active', 1)->with(['municipality.landmarks'])->get();
        dd($areas);

        // Връщаме изгледа с предадените области
        return view('pages.area', compact('areas'));
    }
}