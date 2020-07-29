<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\MetaWheater AS weather;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the index of web page.
     * 
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $weather = weather::getWeather(isset($input['q']) ? $input['q'] : 'jakarta');
        return view('welcome', ['data' => $weather, 'current' => 'home']);
    }

    public function dashboard(){
        $data = weather::getDashboardData();
        return view('dashboard', ['current' => 'dashboard', 'data' => $data]);
    }
}