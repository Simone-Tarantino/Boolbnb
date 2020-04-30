<?php

namespace App\Http\Controllers\Api;
use App\House;
use App\Extra;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function filterLatLong(Request $request)
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
        $dataDistance = intval($data['distance']);


        foreach ($houses as $key => $house) {
            $houseLat = $house->latitude;
            $houseLon = $house->longitude;
            $houseExtra = $house->extras;
            
            $result = distanceResults($houseLat, $houseLon, $dataLat, $dataLon, 'k');
            if ($result <= $dataDistance) {
                $filterHouse[] = $house;
            }
        }
        $houses = $filterHouse;

        return json_encode($houses);
    }   

}
