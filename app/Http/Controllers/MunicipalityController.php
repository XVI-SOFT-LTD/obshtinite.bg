<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Http\Controllers\Controller;

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
        
        return view('pages.municipality', compact('municipality'));
    }

}