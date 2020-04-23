<?php

namespace App\Http\Controllers\Api;
use App\House;
use App\Extra;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function addressFilter(Request $request)
    {
        $data = $request->all();

        $distances = [];


        $houses = House::all();

        // $houses = House::where('longitude', '<', $lon1 + $rad * 0.1)
        //     ->where('longitude', '>', $lon1 - $rad * 0.1)
        //     ->where('latitude', '<', $lat1 + $rad * 0.1)
        //     ->where('latitude', '>', $lat1 - $rad * 0.1)
        //     ->get();


        foreach ($houses as $houseKey => $house) {

            $lat1 = $data['latitude'];
            $lon1 = $data['longitude'];
            $rad = $data['radius'];
            $lat2 = $house->latitude;
            $lon2 = $house->longitude;

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
            $distances[] = $km;
            dd(count($distances, COUNT_NORMAL));
            for ($i=0; $i < $distances; $i++) {
            
            }
            // if ($km <= $rad && ) {
            //     $house->distanceFromPoint = $km;
            // }

        }



        return json_encode($result);
    }

// public function filter(Request $request)
// {

//     $dataRequest = $request->all();

//     $data = [];

//     if ($dataRequest['wifi'] == '1') {
//         $extraWifi = Extra::where('name', 'Wifi')->first();
//         $houseWifi = $extraWifi->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//         $data[] = $houseWifi;
//     }
//     if ($dataRequest['posto_macchina'] == '1') {
//         $extraPostoMacchina = Extra::where('name', 'Posto Macchina')->first();
//         $housePostoMacchina = $extraPostoMacchina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//         $data[] = $housePostoMacchina;
//     }
//     if ($dataRequest['piscina'] == '1') {
//         $extraPiscina = Extra::where('name', 'Piscina')->first();
//         $housePiscina = $extraPiscina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//         $data[] = $housePiscina;
//     }
//     if ($dataRequest['portineria'] == '1') {
//         $extraPortineria = Extra::where('name', 'Portineria')->first();
//         $housePortineria = $extraPortineria->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//         $data[] = $housePortineria;
//     }
//     if ($dataRequest['sauna'] == '1') {
//         $extraSauna = Extra::where('name', 'Sauna')->first();
//         $houseSauna = $extraSauna->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//         $data[] = $houseSauna;
//     }

//     return json_encode($data);
// }


}
