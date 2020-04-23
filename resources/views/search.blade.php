@extends('layouts.app')

@section('content')
<div class="main container-fluid">

        <div class="search_box">
    <input id="address" type="text" class="address-input" name="" placeholder="Cerca Indirizzo">
    <input type="number" name="radius" id="radius">
    {{-- suggerimenti ricerca --}}
    <div class="results">

    </div>


        <input id="address-lat" class="d-none" type="text"  name="latitude"  value="" readonly placeholder="latitudine">
        <input id="address-long" class="d-none" type="text" name="longitude" value="" readonly placeholder="longitudine">

        <button class="btn_search" id='search'>Search</button>

    </div>

    {{-- risultati dalla home da cancellare quando si fa chiamata api --}}

    <div class="home-results">
        @foreach ($distances as $distanceKey => $distance)
        @foreach ($houses as $houseKey => $house)
            @if ($distance <= 20 && $distanceKey == $houseKey)
                  {{$house->address}}
                  <br>
                  {{$distance}}
                  <br>
                  @endif
        @endforeach
        @endforeach
    </div>

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

@endsection
