@extends('layouts.layout')

{{-- @extends('layouts.app') --}}

@section('main')
    @if($errors->any())
            <div class="alert alert-danger">
            <h4>{{$errors->first()}}</h4>
        </div>
    @endif
<div class="main_home">
    <div class="jumbo">
        <div class="title">
            <h1>Benvenuto Scegli <br> Il Tuo Prossimo <br> Soggiorno</h1>
        </div>
        <div class="img">
            <img src="https://images.unsplash.com/photo-1572120360610-d971b9d7767c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="">
        </div>
    </div>
    
    <div class="search_box">
        <input id="address" type="text" class="address-input" name="" placeholder="Cerca Indirizzo">
        {{-- <button class="search" type="submit">Cerca</button> --}}
        <div class="results">
            
        </div>
        <form method="POST" action="{{ route('house.search') }}">
            @csrf
            @method('POST')
            <input id="address-lat" class="d-none" type="text"  name="latitude" id="" value="" readonly placeholder="latitudine">
            <input id="address-long" class="d-none" type="text" name="longitude" id="" value="" readonly placeholder="longitudine">
            
            <button class="btn_search" type="submit">Search</button>
        </form>
        
    </div>



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
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection