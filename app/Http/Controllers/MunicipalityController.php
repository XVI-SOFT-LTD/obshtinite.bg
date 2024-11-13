<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Landmark;
use App\Models\Municipality;

class MunicipalityController extends Controller
{
    private $municipalitiesModel;

    public function __construct()
    {
        $this->municipalitiesModel = new Municipality();
    }

    public function show(string $slug)
    {
        $municipality = $this->municipalitiesModel->where('slug', $slug)->firstOrFail();

        $landmarks = (new Landmark())->getAllLandmarksHomepage();

        return view('municipality.show', [
            'municipality' => $municipality,
            'landmarks' => $landmarks,
        ]);
    }

}
