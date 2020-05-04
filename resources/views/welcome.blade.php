@extends('layouts.layout')
@section('main')
<main>
    <div class="container">
        {{-- SEARCH-BOX --}}
        <div class="search-container">
            <h1>Inserisci la tua prossima destinazione:</h1>
            <div class="search_box">
                <input id="address" type="text" class="address-input" name="" placeholder="Cerca Indirizzo">
                {{-- RISULTATI DESTINAZIONE SUGGERITI --}}
                <div class="results container">
                                
                </div>
                {{-- NASCOSTO --}}
                <form method="POST" action="{{ route('house.search') }}">
                    @csrf
                    @method('POST')
                    <input id="address-lat" class="d-none" type="text"  name="latitude" id="" value="" readonly placeholder="latitudine">
                    <input id="address-long" class="d-none" type="text" name="longitude" id="" value="" readonly placeholder="longitudine">    
                    {{-- /NASCOSTO --}}
                    <button class="btn_search" type="submit"><i class="fas fa-search"></i> Cerca</button>
                </form>
            </div>
        </div>
        {{-- APPARTAMENTI SPONSORIZZATI --}}
        <div class="sponsored-container">
            
            <h3><i class="fas fa-star"></i> Alcune delle nostre mete preferite:</h3>
            <div class="sponsored-houses">
                <div class="row _row">
                    @foreach ($sponsoredHouses as $promo)
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 space">
                            <div class=" card card_box" style="width: 18rem;">
                                <div class="sponsored">
                                    Sponsored
                                </div>
                                <div class="card-wrap">
                                    <img class="card-img-top" src="{{asset('storage/'.$promo->img_path)}}" alt="Card image cap">   
                                </div>
                                <div class="card-body">
                                    <h5 class="card-text text-truncate">{{$promo->address}}</h5>
                                    <a href="{{route('house.show', $promo->id)}}" class="btn btn-primary">Visita</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>   
            
        </div> 
    </div>       
</main>
@endsection


{{-- COLLEGAMENTO SCRIPT --}}
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

@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
{{-- HANDLEBARS --}}
@endsection