@extends('layouts.app')

@section('content')
<div class="main container-fluid">
    <div class="search">
        <form action="">
            <input type="text" name="" id="">
            <button class="btn btn-primary" type="submit">Cerca</button>
        </form>
    </div>
    
    {{-- {{$address = $_GET['address']}}
    {{$lat = $_GET['latitude']}}
    {{$long = $_GET['longitude']}} --}}
    {{-- @php
function distance($lat1, $lon1, $lat2, $lon2) {
    
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;
    
    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;
    
    //echo '<br/>'.$km;
    return $km;
}
@endphp

@foreach ($houses as $house)
$lat1 = $_GET['latitude'];
$lon1 = $_GET['longitude'];
$lat2 = $house->latitude;
$lon2 = $house->longitude;}}

    @dd(distance($lat1, $lon1, $lat2, $lon2));
    

@endforeach --}}


    {{-- @php

    1)

    // $circle_radius = 3959;
    // $max_distance = 20;
    // $lat = $_GET['latitude'];
    // $lng = $_GET['longitude'];
    

    // return $houses = boolbnb::select('SELECT * FROM
    //                 (SELECT id, address, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
    //                 cos(radians(longitude) - radians(' . $lng . ')) +
    //                 sin(radians(' . $lat . ')) * sin(radians(latitude))))
    //                 AS distance
    //                 FROM houses) AS distances
    //             WHERE distance < ' . $max_distance . '
    //             ORDER BY distance
    //             LIMIT 0, 20;
    //         ');
    //         dd ($houses);

    2)

    $lat = $_GET['latitude'];
    $lon = $_GET['longitude'];

    DB::table("houses")
    ->select("houses.id"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(houses.latitude)) 
        * cos(radians(houses.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(houses.latitude))) AS distance"))
        ->groupBy("houses.id")
        ->get();

        dd ($lat, $lon); --}}

            {{-- @endphp --}}

            
 
    {{-- <div class="sposored">
        <h2>Case in evidenza:</h2>
        <div class="appartaments">
           @foreach ($houses as $house)
                @if($house->status == 1 )
                    <h2>Numero appartamento {{$house->id}}, pubblicato da {{$house->user_id}}</h2>
                    <ul>
                        <li>Numero Stanze:{{$house->room_number}}</li>
                        <li>Numero Letti: {{$house->bed}}</li>
                        <li>Numero Bagni:{{$house->bathroom}}</li>
                        <li>Metri Quadri Appartamento: {{$house->mq}}</li>
                        <li>Indirizzo: {{$house->address}}</li>
                        <li>Foto: {{$house->img_path}}</li>
                        <li>Caricato il:{{$house->created_at}}</li>
                        <li>Modificato il: {{$house->updated_at}}</li>
                        @if ($house->status == 1)
                            <li>Pubblicato: Si</li> 
                        @else 
                            <li>Pubblicato: no</li>
                        @endif
                        <li><a href="{{route('house.show', $house)}}">Mostra appartamento</a></li>
                @endif
            @endforeach          
        </div>
    </div>
</div> --}}
@endsection
