@extends('layouts.layout')
@extends('layouts.app')

@section('main')
<div class="main container-fluid">

        <div class="search_box">
    <input id="address" type="text" class="address-input" name="" placeholder="Cerca Indirizzo">
    <input type="number" name="distance" id="distance">
    {{-- suggerimenti ricerca --}}
    <div class="results">

    </div>


        <input id="address-lat" type="text"  name="latitude"  value="" readonly placeholder="latitudine">
        <input id="address-long" type="text" name="longitude" value="" readonly placeholder="longitudine">

        <button class="btn_search" id='search'>Search</button>

    </div>

    {{-- risultati dalla home da cancellare quando si fa chiamata api --}}

    <div class="home-results">
        @foreach ($houses as $house)
                  {{$house->address}}
                  {{$house->distance}}
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
@section('scripts')
            
            <script src="{{asset('js/search.js')}}"></script>
        @endsection