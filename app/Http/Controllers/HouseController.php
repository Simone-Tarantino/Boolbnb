<?php

namespace App\Http\Controllers;

use App\House;
use App\Extra;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        $randomHouses = House::inRandomOrder()->where('status', 1)->whereHas('sponsors')->get();
        $sponsoredHouses = [];
        foreach ($randomHouses as $house) {
            foreach ($house->sponsors as $sponsor) {
                
                $now = Carbon::now();

                $expiring_date = $sponsor->pivot->created_at->addHours($sponsor->duration);
                
                if ($now < $expiring_date && !in_array($house, $sponsoredHouses) && count($sponsoredHouses) < 3) {
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
            $theta = $lon1 - $longitude;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($latitude)) +  cos(deg2rad($lat1)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
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
        $houses = $filterHouse;
        if (count($filterHouse) <= 0) {
            $data = [
                'houses' => $houses,
                'sponsoredHouses' => $sponsoredHouses
            ];
            return view('search', $data)->withErrors(['Nessun appartamento trovato nel raggio di 20km', 'The Message']);;
        } 
        $data = [
            'houses' => $houses,
            'sponsoredHouses' => $sponsoredHouses
        ];
        return view('search', $data);
    }
}
