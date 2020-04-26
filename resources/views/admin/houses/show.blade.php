@extends('layouts.layout')
@extends('layouts.app')
@section('main')
<div class="container main_show">
    <div class="row">
        <img class="col-sm-7 offset-sm-5 img_show" src="{{$house->img_path}}" alt="">
    </div>
    <h2>{{$house->address}}</h2>



</div>










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
            <div class='coord-lat' value="{{$house->latitude}}">{{$house->latitude}}</div>
            <div class='coord-lon' value="{{$house->longitude}}">{{$house->longitude}}</div>
            @if ($house->status == 1)
            <li>Pubblicato: Si</li> 
            @else 
               <li>Pubblicato: no</li>
            @endif
            @if($house->user_id == Auth::user()->id)
            <li><a href="{{route('admin.houses.edit', $house)}}">Modifica dati</a></li>
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

@section('footer')
    <div class="footer">
        <div class="container footer_top">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>INFORMAZIONI</h5></li>
                        <li>Diversità e appartenenza</li>
                        <li>Boolbnb Citizen</li>
                        <li>Accessibilità</li>
                        <li>Newsroom</li>
                        <li>Affidabilità e Sicurezza</li>
                    </ul>                  
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>COMMUNITY</h5></li>
                        <li>Boolbnb Magazine</li>
                        <li>Opportunità di Lavoro</li>
                        <li>Boolbnb for Work</li>
                        <li>Invita degli amici</li>
                    </ul>                  
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>OSPITA</h5></li>
                        <li>Diventa Host</li>
                        <li>Proponi un' esperienza</li>
                        <li>Olimpiadi</li>
                        <li>Affittare Responsabilmente</li>
                        <li>Centro Risorse</li>
                    </ul>                  
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>ASSISTENZA</h5></li>
                        <li>Centro Assistenza</li>
                        <li>Servizio di assistenza di quartiere</li>    
                    </ul>                  
                </div>
            </div>
        </div>
            <div class="container footer_bottom">
                <div class="row">
                    <div class="col-md-7">
                        <p>© 2020 Boolbnb, Inc. All rights reserved  ·  Privacy  ·  Termini  ·  Mappa del sito  ·  Dettagli dell'azienda</p>
                    </div>
                    <div class="col-md-5 footer_bottom_right">
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-facebook-f"></i>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('scripts') 
    <script src="{{asset('js/map.js')}}"></script>
@endsection