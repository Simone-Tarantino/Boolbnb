<?php

namespace App\Http\Controllers;
use App\House;
use App\Extra;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        $houses = House::all();
        return view('home', compact('houses'));
    }

    public function show(House $house)
    {
        $extras = Extra::all();
        if (empty($house)) {
            abort('404');
        }

        return view('show', compact('house'));
    }
}
