@extends('layouts.layout')
@extends('layouts.app')
@section('main')
    <li><input type="text" class="address-input" name="" placeholder="Cerca Indirizzo"></li>
    <button class="search" type="submit">Cerca</button>
    <div class="results">

    </div>
    <form method="POST" action="{{ route('house.search') }}">
        @csrf
        @method('POST')
        {{-- <li><input id="address" type="text" class='indirizzo' name="address" id="address" value="" readonly placeholder="Indirizzo"></li> --}}
        <li><input id="address-lat" type="text"  name="latitude" id="" value="" readonly placeholder="latitudine"></li>
        <li><input id="address-long" type="text" name="longitude" id="" value="" readonly placeholder="longitudine"></li>
    
        <button type="submit">Vai</button>
    </form>













        <script id="entry-template" type="text/x-handlebars-template">
            <div class="entry-result">
                <div class="indirizzo">
                    <h1>@{{address}}</h1>
                    <ul class="coord">
                        <input class="lat" type="text" value="@{{latitude}}" name="" id="" readonly>
                        <input class="long" type="text" value="@{{longitude}}" name="" id="" readonly>
                    </ul>
                </div>
            </div>
        </script>
@endsection
