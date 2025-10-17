<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function fasilitas()
    {
        return view('explore.fasilitas');
    }
    
    public function extrakurikuler()
    {
        return view('explore.extrakurikuler');
    }
    
    public function islamicLife()
    {
        return view('explore.islamic-life');
    }
    
    public function schoolLife()
    {
        return view('explore.school-life');
    }
}