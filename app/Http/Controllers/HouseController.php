<?php

namespace App\Http\Controllers;
use App\House;
use App\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        function distanceResults($lat1, $lon1, $latitude, $longitude, $unit)
        {
            //longitudine e latitudine in radianti
            //angolo ϑ con l'asse x in un piano-xy in coordinate (longitudine e latitudine)
            $theta = $lon1 - $longitude;
            //function Korn Shell che prevede serie di operatori matematici e trigonometrici
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($latitude)) +  cos(deg2rad($lat1)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
            //calcolo della distanza
            $dist = acos($dist);
            $dist = rad2deg($dist);
            //conversione distanza da radianti in miglia
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            //cambio unità di misura
            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        
        };       
    

        $houses = House::where('status', 1)->get();

        $data = $request->all();
        $dataLat = floatval($data['latitude']);
        $dataLon = floatval($data['longitude']);


        foreach ($houses as $key => $house) {
            $houseLat = $house->latitude;
            $houseLon = $house->longitude;
        
            $result = distanceResults($houseLat, $houseLon, $dataLat, $dataLon, 'k');
            if ($result <= 20) {
                $filterHouse[] = $house;
            }
        }
        $houses = $filterHouse;
        return view('search', compact('houses'));
    }
    

}
