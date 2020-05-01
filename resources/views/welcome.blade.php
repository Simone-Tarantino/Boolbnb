@extends('layouts.layout')

@section('main')
@if($errors->any())
    <div id ="noResults" class="alert alert-danger">
        <h4>{{$errors->first()}}</h4>
    </div>
    @endif
    {{-- <div class="container">
        <div class="jumbo">
            <div class="title">
                <h1>Benvenuto Scegli <br> Il Tuo Prossimo <br> Soggiorno</h1>
            </div>
        </div>
    </div> --}}
    {{-- SEARCH-BOX --}}
<div class="container">
    <section id="search-section" class="demo">
        <div class="search-container">
            <h3>Inserisci la tua prossima destinazione:</h3>
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
                        
                    <button class="btn_search" type="submit">Cerca</button>
                </form>
                {{-- /NASCOSTO --}}
            </div>
        </div>

        <div class="sponsored-preview">
            <div class="sponsored-container">
                <h3>Alcune delle nostre mete preferite:</h3>
                <div class="sponsored-houses">
                    @foreach ($sponsoredHouses as $promo)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{asset('storage/'.$promo->img_path)}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$promo->address}}</h5>
                                <p class="card-text">{{$promo->description}}</p>
                                <a href="{{route('house.show', $promo->id)}}" class="btn btn-primary">Visita</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <a class="down" href="#sponsored-section">Scopri tutte le nostre mete preferite <i class="fas fa-arrow-down bounce"></i></a>
    </section>
          
          
    <section id="sponsored-section" class="sponsored">
        <h3>Alcune delle nostre mete preferite:</h3>
        <div class="sponsored-houses">
            @foreach ($allSponsoredHouses as $promo)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('storage/'.$promo->img_path)}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$promo->address}}</h5>
                        <p class="card-text">{{$promo->description}}</p>
                        <a href="{{route('house.show', $promo->id)}}" class="btn btn-primary">Visita</a>
                    </div>
                </div>
            @endforeach
        </div>   
        <a class="up" href="#search-section">Torna alla ricerca <i class="fas fa-arrow-up bounce"></i></a>
    </section>

</div>

    
<script id="entry-template" type="text/x-handlebars-template">
    <div class="entry-result">
        <div class="indirizzo">
            <p>@{{address}} @{{noResults}}</p>
            
            <ul class="coord">
                <input class="lat d-none" type="text" value="@{{latitude}}" name="" id="" readonly>
                <input class="long d-none" type="text" value="@{{longitude}}" name="" id="" readonly>
            </ul>
        </div>
    </div>
</script>
@endsection
    

{{-- COLLEGAMENTO SCRIPT --}}
@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
{{-- HANDLEBARS --}}
@endsection