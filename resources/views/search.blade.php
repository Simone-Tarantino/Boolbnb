@extends('layouts.layout')
@extends('layouts.app')

@section('main')
<div class="main">

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
    
    <div class="house-results">
        @foreach ($houses as $house)
        {{$house->address}}
        {{$house->distance}}
        {{$house->bed}}
        {{$house->bathroom}}
        {{$house->img_path}}
        {{$house->id}}
        {{$house->mq}}
        {{$house->room_number}}
        @foreach ($house->extras as $extra)
            {{$extra->name}}
        @endforeach
                  <li><a href="{{route('house.show', $house->id)}}">Mostra appartamento</a></li>
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

        <script id="search-template" type="text/x-handlebars-template">
            <div class="entry-result">
                    <ul class="house">
                        <li>@{{address}}</li>
                        <li>@{{bathroom}}</li>
                        <li>@{{bed}}</li>
                        <li>@{{img_path}}</li>
                        <li>@{{id}}</li>
                        <li>@{{mq}}</li>
                        <li>@{{room_number}}</li>
                        <li class="extras">extras:
                            @{{extras}}
                        </li>
                        <li><a href="http://127.0.0.1:8000/show/@{{id}}">Mostra appartamento</a></li>
                    </ul>
                </div>
            </div>
        </script>

@endsection

@section('scripts')          
    <script src="{{asset('js/search.js')}}"></script>
@endsection