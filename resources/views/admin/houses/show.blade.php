@extends('layouts.layout')
{{-- @extends('layouts.app') --}}
@section('main')
<div class="container main_show">
    <div class="row">
        <img class="col-sm-7 offset-sm-5 img_show" src="{{asset('storage/'.$house->img_path)}}" alt="">
    </div>
    <h2 class="address-map">{{$house->address}}</h2>
    <ul class="list-inline">
        <li class="list-inline-item">{{$house->bed}} letti</li>
        <li class="list-inline-item">{{$house->room_number}} camere</li>
        <li class="list-inline-item">{{$house->bathroom}} bagni</li>
        <li class="list-inline-item">{{$house->mq}} mq</li>
    </ul>
    <ul class="list-inline">
        @if ($house->status == 1)
        <li class="list-inline-item">Questo appartamento è pubblicato</li> 
        @else 
        <li class="list-inline-item">Questo appartamento non è pubblicato</li>
        @endif
    </ul>
    <h4>DESCRIZIONE</h4>
    <p>{{$house->description}}</p>


</div>
<div class='coord-lat d-none' value="{{$house->latitude}}">{{$house->latitude}}</div>
<div class='coord-lon d-none' value="{{$house->longitude}}">{{$house->longitude}}</div>
           
            
            @if($house->user_id == Auth::user()->id)
            <li><a href="{{route('admin.houses.edit', $house)}}">Modifica dati</a></li>
            @endif
        </ul>
        <ul>
            @if($house->user_id == Auth::user()->id)
            <a href="{{route('admin.sponsor',$house->id)}}">Sponsorizza l'appartamento</a>
            @endif
        </ul>
        <ul>
        <li><h3>Servizi extra</h3></li>
        @foreach ($house->extras as $extra)
        <li>{{$extra->name}}</li>
            
        @endforeach
        </ul>
        <div id="map" ></div>
        </div>
@endsection



@section('scripts') 
    <script src="{{asset('js/map.js')}}"></script>
@endsection