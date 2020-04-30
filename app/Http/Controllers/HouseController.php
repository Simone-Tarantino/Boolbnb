<?php

namespace App\Http\Controllers;

use App\House;
use App\Extra;
use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    // METODO NOSTRO :(

    // public function index()
    // {
    //     $houses = House::all();
    //     return view('welcome', compact('houses'));
    // }

    public function index()
    {
        $houses = House::where('status', 1)->get();
        $sponsoredHouses = [];

        foreach ($houses as $house) {
            foreach ($house->sponsors as $sponsor) {
                
                $now = Carbon::now();

                $expiring_date = $sponsor->pivot->created_at->addHours($sponsor->duration);
                
                if ($now < $expiring_date && !in_array($house, $sponsoredHouses)) {
                    $sponsoredHouses[] = $house;       
                }
            }
        }
        return view('welcome', compact('sponsoredHouses'));
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
        $filterHouse = [];
        $sponsoredHouses = [];

        foreach ($houses as $house) {
            foreach ($house->sponsors as $sponsor) {

                $now = Carbon::now();

                $expiring_date = $sponsor->pivot->created_at->addHours($sponsor->duration);

                if ($now < $expiring_date && !in_array($house, $sponsoredHouses)) {
                    $sponsoredHouses[] = $house;
                }
            }
        }
        
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
        if (count($filterHouse) <= 0) {
            return redirect()->back()->withErrors(['Nessun appartamento trovato', 'The Message']);
        } 

        $houses = $filterHouse;
        $data = [
            'houses' => $houses,
            'sponsoredHouses' => $sponsoredHouses
        ];
        
        return view('search', $data);
    }
}
