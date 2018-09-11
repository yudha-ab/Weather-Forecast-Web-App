<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\MetaWheater AS weather;

class IndexController extends Controller
{
    /**
     * Show the index of web page.
     * 
     */
    public function index()
    {
        $weather = weather::getWeather('jakarta');
        return view('welcome', ['data' => $weather]);
    }
}