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


}
