@extends('layouts.layout')
@extends('layouts.app')
@section('main')
    <h2>Numero appartamento {{$house->id}}, pubblicato da {{$house->user_id}}</h2>
        <ul>
            <li>Numero stanze:{{$house->room_number}}</li>
            <li>Numero letti:{{$house->bed}}</li>
            <li>Numero bagni:{{$house->bathroom}}</li>
            <li>Metri Quadri Appartamento: {{$house->mq}}</li>
            <li class="address">Indirizzo: {{$house->address}}</li>
            <li>Foto: {{$house->img_path}}</li>
            <li>Caricato il: {{$house->created_at}}</li>
            <li>Modificato il: {{$house->updated_at}}</li>
            <div class='coord-lat'>{{$house->latitude}}</div>
            <div class='coord-lon'>{{$house->longitude}}</div>
        </ul>
        <ul>
        <li><h3>Servizi extra</h3></li>
        @foreach ($house->extras as $extra)
        <li>{{$extra->name}}</li>
            
        @endforeach
        </ul>
        
        <div id="map"></div>
        </div>
    <script src="{{asset('js/map.js')}}"></script>
@endsection