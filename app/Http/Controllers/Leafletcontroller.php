<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Leafletcontroller extends Controller
{
    public function index() 
    {
       return view('leaflet');
    }
}
