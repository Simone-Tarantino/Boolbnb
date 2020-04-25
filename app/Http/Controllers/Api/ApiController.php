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

        $published = 1;
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
                WHERE distance < ' . $max_distance . ' AND status = ' . $published . '
                ORDER BY distance;
                ');

        return json_encode($houses);

    }

    function getHouseForExtra(Request $request)
    {
        // $extra = Extra::all();
        // $house= House::all();
        // $published = 1;
        // $results = DB::table('extra_house')
        //         ->join('houses', 'extra_house.house_id', '=', 'houses.id')
        //         ->where('status', '=', $published)
        //         ->whereIn('extra_id', $extra)
        //         ->get();
        // return json_encode($results);

        $houses = House::all();

        $data = $request->all();

        $typeRequest = [
            'wifi',
            'posto_macchina',
            'piscina',
            'portineria',
            'sauna'
        ];

        foreach ($data as $key => $value) {
            if (!in_array($key, $typeRequest)) {
                unset($data[$key]);
            }
        }

        foreach ($data as $key => $value) {
            if (array_key_first($data) == $key) {
                $housesFiltered = $this->filterFor($key, $value, $houses);
            }

            else {
                $housesFiltered = $this->filterFor($key, $value, $housesFiltered);
            }
        }


        // if ($dataRequest == '1') {
        //     $extra = Extra::find(2);
        //     $extra->houses;
        //     $data[] = $extra;
        // }
        // if ($dataRequest['posto_macchina'] == '1') {
        //     $extraPostoMacchina = Extra::where('name', 'Posto Macchina')->first();
        //     $housePostoMacchina = $extraPostoMacchina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
        //     $data[] = $housePostoMacchina;
        // }
        // if ($dataRequest['piscina'] == '1') {
        //     $extraPiscina = Extra::where('name', 'Piscina')->first();
        //     $housePiscina = $extraPiscina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
        //     $data[] = $housePiscina;
        // }
        // if ($dataRequest['portineria'] == '1') {
        //     $extraPortineria = Extra::where('name', 'Portineria')->first();
        //     $housePortineria = $extraPortineria->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
        //     $data[] = $housePortineria;
        // }
        // if ($dataRequest['sauna'] == '1') {
        //     $extraSauna = Extra::where('name', 'Sauna')->first();
        //     $houseSauna = $extraSauna->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
        //     $data[] = $houseSauna;
        // }

        return json_encode($housesFiltered);
    }

    private function filterFor($type, $value, $array)
    {

        $filtered = [];
        foreach ($array as $element) {
            if ($element[$type] == $value) {
                $filtered[] = $element;
            }
        }
        return $filtered;
    }
    
}
