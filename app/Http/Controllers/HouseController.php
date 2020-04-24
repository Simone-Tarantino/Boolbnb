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

        $data = $request->all();

        $circle_radius = 6372.797;
        $max_distance = 20;
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
            '
        );
        
        return view('search', compact('houses'));
    }

}
