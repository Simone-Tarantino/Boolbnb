@extends('layouts.layout')
@section('main')
@if($errors->any())
    <div id ="noResults" class="alert alert-danger">
        <h4>{{$errors->first()}}</h4>
    </div>
@endif
<div class="container searchHouses">
    <div class="main-search">
    <h1 class="mt-4 mb-4 primary">Appartamenti</h1>
        {{-- ricerca indirizzo e raggio --}}
        <div class="search_box">
            <input id="address" type="text" class="address-input" name="" placeholder="Cerca Indirizzo">
            {{-- suggerimenti ricerca --}}
            <div class="results container">
            </div>
            <input class="d-none" id="address-lat" type="text"  name="latitude"  value="" readonly placeholder="latitudine">
            <input class="d-none" id="address-long" type="text" name="longitude" value="" readonly placeholder="longitudine">
            <button class="btn_search" id='search'>Search</button>
            <label for="distance"><i class="fas fa-map-marker-alt option_icon"></i> <span class="radius-text">Raggio di ricerca (KM)</span></label>
            <input min="20" max="999" type="number" name="distance" id="distance">
        </div>
        {{-- filtra risultati jquery --}}
        <div class="filters">
            <i class="fas fa-bed option_icon"></i><label for="beds">Letti</label>
            <input min="1" max="10" type="number" name="beds" id="beds" placeholder="1-10">
            <i class="fas fa-toilet option_icon"></i><label for="bathroom">Bagni</label>
            <input min="1" max="5" type="number" name="bathroom" id="bathrooms" placeholder="1-5">
            <i class="fas fa-door-open option_icon"></i><label for="room_number">Stanze</label>
            <input  min="1" max="5"type="number" name="room_number" id="room_number" placeholder="1-5">
            <div class="extras">
                <i class="fas fa-wifi extra_icon"></i> <label for="checkbox">WiFi</label>
                <input type="checkbox"  class="checkbox-filter" name="extra" value="WiFi" id="">
                <i class="fas fa-parking extra_icon"></i> <label for="checkbox">Parcheggio</label>
                <input type="checkbox" class="checkbox-filter" name="extra" value="Parcheggio" id="">
                <i class="fas fa-swimmer extra_icon"></i> <label for="checkbox">Piscina</label>
                <input type="checkbox" class="checkbox-filter" name="extra" value="Piscina" id="">
                <i class="fas fa-concierge-bell extra_icon"></i> <label for="checkbox">Portineria</label>
                <input type="checkbox" class="checkbox-filter" name="extra" value="Portineria" id="">
                <i class="fas fa-hot-tub extra_icon"></i> <label for="checkbox">Sauna</label>
                <input type="checkbox" class="checkbox-filter" name="extra" value="Sauna" id="">
                <button type="submit" class="btn_filters" id="filter-button">Filtra</button>
                <button type="submit" class="btn_filters" id="remove-filters">Rimuovi Filtri</button>
            </div>
        </div>
        {{-- risultati dalla home da cancellare quando si fa chiamata api --}}
        <div class="container-fluid container-sponsored">
            <div class="row">
                @foreach ($sponsoredHouses as $housePromo)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="card card_box">
                            <div class="sponsored">
                                Sponsored
                            </div>
                            <div class="img_container">
                                <img src="{{asset('storage/'.$housePromo->img_path)}}" class="card-img-top img" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{$housePromo->address}}</h5>
                                <p class="card-text card_text"><i class="fas fa-door-open"></i>Camere: {{$housePromo->room_number}}</p>
                                <p class="card-text card_text"><i class="fas fa-toilet"></i>N° Bagni: {{$housePromo->bathroom}}</p>
                                <p class="card-text card_text"><i class="fas fa-bed"></i>Posti letto: {{$housePromo->bed}}</p>
                                <a href="{{route('house.show', $housePromo->id)}}" class="btn btn_look">Vedi Appartamento</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid container-sponsored">
        <div class="row house-results">
            @foreach ($houses as $house)
                <div class="house-container-bt col-lg-4 col-sm-6 col-xs-12">
                    <div class="card house card_box">
                        <div class="img_container">
                            <img src="{{asset('storage/'.$house->img_path)}}" class="card-img-top img" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{$house->address}}</h5>
                            <i class="fas fa-door-open"></i>Numero di stanze: <span class="card-text card_text room_number">{{$house->room_number}}</span><br>
                            <i class="fas fa-toilet"></i>Numero di bagni: <span class="card-text card_text bathroom">{{$house->bathroom}}</span><br>
                            <i class="fas fa-bed"></i>Numero di letti: <span class="card-text card_text bed">{{$house->bed}}</span>
                            <div class="extras d-none">
                                <h5 >Servizi extra:</h5>
                                @foreach ($house->extras as $extra)
                                    {{$extra->name}}
                                @endforeach
                            </div>
                        <a class="btn btn_look" href="{{route('house.show', $house->id)}}">Mostra appartamento</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> 
    </div>
        {{-- SCRIPTS --}}
    <script id="entry-template" type="text/x-handlebars-template">
        <div class="entry-result">
            <div class="indirizzo">
                <p>@{{address}}</p>
                <ul class="coord">
                    <input class="lat d-none" type="text" value="@{{latitude}}" name="" id="" readonly>
                    <input class="long d-none" type="text" value="@{{longitude}}" name="" id="" readonly>
                </ul>
            </div>
        </div>
    </script>
    <script id="search-template" type="text/x-handlebars-template">
        <div class="entry-result col-lg-4 col-sm-6 col-xs-12">
            <div class="card house card_box">
                <div class="img_container">
                    <img src="{{ url('storage/')}}/@{{ img_path }}" class="card-img-top img" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate">@{{address}}</h5>
                    <i class="fas fa-door-open"></i>Numero di stanze: <span class="card-text card_text room_number">@{{room_number}}</span><br>
                    <i class="fas fa-toilet"></i>Numero di bagni: <span class="card-text card_text bathroom">@{{bathroom}}</span><br>
                    <i class="fas fa-bed"></i>Numero di letti: <span class="card-text card_text bed">@{{bed}}</span><br>
                    <div class="extras d-none">
                        @{{extras}}
                    </div>
                    <a class="btn btn_look" href="http://127.0.0.1:8000/show/@{{id}}">Mostra appartamento</a>
                </div>
            </div>
        </div>
    </script>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/search.js')}}"></script>
    <script src="{{asset('js/filter.js')}}"></script>
@endsection