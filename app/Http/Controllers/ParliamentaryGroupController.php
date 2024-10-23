<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ParliamentaryGroup;

class ParliamentaryGroupController extends Controller
{
    private $parliamentaryGroupsModel;
    
    public function __construct()
    {
        $this->parliamentaryGroupsModel = new ParliamentaryGroup();
    }

    public function show(string $slug)
    {
        $parliamentaryGroup = $this->parliamentaryGroupsModel->where('slug', $slug)->firstOrFail();
        // dd($parliamentaryGroup);
        
        return view('pages.parliamentarygroup', compact('parliamentaryGroup'));
    }
}