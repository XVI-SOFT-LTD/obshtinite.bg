<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;

class AreaController extends Controller
{
    private $areaModel;

    public function __construct()
    {
        $this->areaModel = new Area();
    }

    public function index()
    {
        $areas = $this->areaModel->where('active', 1)->with(['municipality.landmarks'])->paginate(12);

        return view('areas.index', [
            'areas' => $areas,
        ]);
    }

    public function show(string $slug)
    {
        $area = $this->areaModel->where('slug', $slug)->with(['municipality.landmarks'])->firstOrFail();

        return view('pages.area', compact('area'));
    }

}
