@extends('layouts.layout')

{{-- @extends('layouts.app') --}}

@section('main')
{{-- @dd($housesPromo); --}}
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
    </div>
    <div class="container promoted_houses mt-5">
        <h3>Appartamenti in evidenza</h3>
        @foreach ($sponsoredHouses as $promo)
    <img src="{{asset('storage/'.$promo->img_path)}}" alt="foto appartamento">
            <ul>
                
                <li>{{$promo->address}}</li>   
                <li>{{$promo->description}}</li>   
                <li>{{$promo->bed}}</li>   
                <li>{{$promo->room_number}}</li>   
                <li>{{$promo->bathroom}}</li>   
                <li>{{$promo->mq}}</li>   
                <li><h5>Extra</h5>
                    <ul>
                        @foreach ($promo->extras as $extra)</li>  
                      
                        <li>{{$extra->name}}</li>
                        @endforeach
                    </ul>
            <li><p class="card-text">PROMOZIONE FINO AL:{{$promo->sponsors[0]->pivot->created_at->addHour($promo->sponsors[0]->duration)}}</p></li>
            </ul>
        @endforeach
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
        <div class="sponsored_houses">
            @foreach ($sponsoredHouses as $houseSponsored)
                <div class="card box">
                        <img src="{{asset('storage/'.$houseSponsored->img_path)}}" class="card-img-top img" alt="...">
                        <div class="card-body">
                            <h4 class="card-text">APPARTAMENTO SPONSORIZZATO</h4>
                            <p class="card-text">{{$houseSponsored->address}}</p>
                            <p class="card-text">{{$houseSponsored->sponsors[0]->pivot->created_at->addHour($houseSponsored->sponsors[0]->duration)}}</p>
                        </div>
                        <div class="btn_zone">
                            <a class="btn btn-primary btn_look" href="{{route('admin.houses.show', $houseSponsored)}}" role="button">Mostra</a>    
                        </div>
                    </div>
            @endforeach
        </div>
@endsection

<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
@endsection