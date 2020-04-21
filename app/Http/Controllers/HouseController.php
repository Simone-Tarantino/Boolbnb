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
        return view('search', compact('houses'));
    }

    public function show(House $house)
    {
        $extras = Extra::all();
        if (empty($house)) {
            abort('404');
        }

        return view('show', compact('house'));
    }

    public function distance(Request $request)
    {

        $data = $request->all();

        $distances = [];

        $houses = House::all();
        
        foreach ($houses as $house) {
            
    
            $lat1 = $house->latitude;
            $lon1 = $house->longitude;
            $lat2 = $data['latitude'];
            $lon2 = $data['longitude'];
    
    
    
            $pi80 = M_PI / 180;
            $lat1 *= $pi80;
            $lon1 *= $pi80;
            $lat2 *= $pi80;
            $lon2 *= $pi80;
            $r = 6372.797; 
            $dlat = $lat2 - $lat1;
            $dlon = $lon2 - $lon1;
            $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $km = $r * $c;
            //echo ' '.$km; 
            $distances[] = $km;
        }    
        
        $data = [
            'distances' => $distances,
            'houses' => $houses
        ];
        
        return view('search', $data);
    }

}
