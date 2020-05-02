@extends('layouts.layout')

{{-- @extends('layouts.app') --}}

@section('main')
<div class="main_show">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <img class="img_show" src="{{asset('storage/'.$house->img_path)}}" alt="">
                <h2 class="address-map">{{$house->address}}</h2>
                <ul class="list-inline extra">
                    <li class="list-inline-item">{{$house->mq}} mq</li>
                    <li class="list-inline-item">{{$house->room_number}} camere</li>
                    <li class="list-inline-item">{{$house->bed}} posti letti</li>
                    <li class="list-inline-item">{{$house->bathroom}} bagni</li>
                </ul>
                <h4>DESCRIZIONE</h4>
                <p>{{$house->description}}</p>
                <div class='coord-lat d-none' value="{{$house->latitude}}">{{$house->latitude}}</div>
                <div class='coord-lon d-none' value="{{$house->longitude}}">{{$house->longitude}}</div>

                {{-- CONTATTA --}}
                <a class="btn btn-primary btn_show" href="{{route('contactus', $house)}}">Contatta l' Host</a>
                 {{-- MAPPA --}}
                <div id="map"></div>
            </div>{{--  /col --}}  
        </div>{{--  /row --}} 
    </div>{{--  /container --}}
</div>{{--  /main --}}
@endsection

@section('scripts')
    <script src="{{asset('js/map.js')}}"></script>
@endsection