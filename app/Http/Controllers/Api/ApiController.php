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
        $data = $request->all();

        $circle_radius = 6372.797;
        $max_distance = $data['distance'];
        $lat = $data['latitude'];
        $lng = $data['longitude'];

        $houses = DB::select(
               'SELECT * FROM
                    (SELECT id, user_id, room_number, bed, bathroom, mq, address, img_path, status, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
                    AS distance
                    FROM houses) AS distances
                WHERE distance < ' . $max_distance . '
                ORDER BY distance;
            ');

        return json_encode($houses);

        // $data = $request->all();

        // $distances = [];

        // $houses = House::all();

        // foreach ($houses as $house) {


        //     $lat1 = $house->latitude;
        //     $lon1 = $house->longitude;
        //     $lat2 = $data['latitude'];
        //     $lon2 = $data['longitude'];



        //     $pi80 = M_PI / 180;
        //     $lat1 *= $pi80;
        //     $lon1 *= $pi80;
        //     $lat2 *= $pi80;
        //     $lon2 *= $pi80;
        //     $r = 6372.797;
        //     $dlat = $lat2 - $lat1;
        //     $dlon = $lon2 - $lon1;
        //     $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        //     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        //     $km = $r * $c;
        //     //echo ' '.$km; 
        //     $distances[] = $km;
        // }

        // $data = [
        //     'distances' => $distances,
        //     'houses' => $houses
        // ];


        // return json_encode($data);
    }

    
    
    // PROVA

//  public function filter(Request $request)
//  {

//      $dataRequest = $request->all();

//      $data = [];

//      if ($dataRequest['wifi'] == '1') {
//          $extraWifi = Extra::where('name', 'Wifi')->first();
//          $houseWifi = $extraWifi->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $houseWifi;
//      }
//      if ($dataRequest['posto_macchina'] == '1') {
//          $extraPostoMacchina = Extra::where('name', 'Posto Macchina')->first();
//          $housePostoMacchina = $extraPostoMacchina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $housePostoMacchina;
//      }
//      if ($dataRequest['piscina'] == '1') {
//          $extraPiscina = Extra::where('name', 'Piscina')->first();
//          $housePiscina = $extraPiscina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $housePiscina;
//      }
//      if ($dataRequest['portineria'] == '1') {
//          $extraPortineria = Extra::where('name', 'Portineria')->first();
//          $housePortineria = $extraPortineria->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $housePortineria;
//      }
//      if ($dataRequest['sauna'] == '1') {
//          $extraSauna = Extra::where('name', 'Sauna')->first();
//          $houseSauna = $extraSauna->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $houseSauna;
//      }

//      return json_encode($data);
//  }


}
