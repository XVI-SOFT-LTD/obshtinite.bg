<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Landmark;

class LandmarkController extends Controller
{
     private $landmarkModel;
        
    public function __construct()
    {
        $this->landmarkModel = new Landmark();
    }

    public function listAllLandmarks()
    {
          // Извличаме всички активни области
        $landmarks = $this->landmarkModel->where('active', 1)->get();

        // Връщаме изгледа с предадените области
        return view('pages.landmarks-listing', compact('landmarks'));
    }

    public function show(string $slug)
    {
        $landmark = $this->landmarkModel->where('slug', $slug)->firstOrFail();
        
        return view('pages.landmark', compact('landmark'));
    }
}