@extends('layouts.layout')
{{-- @extends('layouts.app') --}}

@section('main')
<main>


@if($errors->any())
    <div id ="noResults" class="alert alert-danger">
        <h4>{{$errors->first()}}</h4>
    </div>
@endif
<div class="container">
    <div class="row searchHouses">
           <h1 class="mt-4 mb-4 service">Appartamenti</h1>
               {{-- ricerca indirizzo e raggio --}}
               <div class="search-container _search">
        
                   <div class="search_box">
                       <input id="address" type="text" class="address-input" name="" placeholder="Cerca Indirizzo">
                       <div class="results container" id="results">
               
                       </div>
                       
                       {{-- suggerimenti ricerca --}}
                       <button class="btn_search" id='search'>Search</button>
                   </div>
                   
                   <input class="d-none" id="address-lat" type="text"  name="latitude"  value="" readonly placeholder="latitudine">
                   <input class="d-none" id="address-long" type="text" name="longitude" value="" readonly placeholder="longitudine">
                  
         {{-- filtri --}}
         <div class="filters">
            {{-- raggio e opzioni camera --}}
            <h5 class="service">Opzioni</h5>
         <div class="wrapper d-flex">
            <div class="option-wrap">
            <label for="distance"><i class="fas fa-map-marker-alt option_icon"></i>Raggio</label>
             <input class="filter_input" type="number" name="distance" id="distance">
             </div>
             <div class="option-wrap">
                <label for="beds"><i class="fas fa-bed option_icon"></i>Letti</label>
             <input class="filter_input" type="number" name="beds" id="beds" placeholder="N° di letti">
             </div>
             <div class="option-wrap">

             <label for="bathroom"><i class="fas fa-toilet option_icon"></i>Bagni</label>
             <input class="filter_input" type="number" name="bathroom" id="bathrooms" placeholder="N° di bagni">
             </div>
             <div class="option-wrap">
            <label for="room_number"><i class="fas fa-door-open option_icon"></i>Stanze</label>
            <input class="filter_input" type="number" name="room_number" id="room_number" placeholder="N° di stanze"> 
             </div>
            
             
             
            </div>
       
        {{-- fine raggio e opzioni camera --}}
        {{-- extras --}}
<div class="extras-filter">
    <h5 class="service">Servizi</h5>
<div class="row">
<div class="col-xs-12 col-md-8">
    <label for="checkbox"><i class="fas fa-wifi extra_icon"></i>WiFi</label>
    <input type="checkbox"  class="checkbox-filter" name="extra" value="WiFi" id="">
    <label for="checkbox"><i class="fas fa-parking extra_icon"></i>Parcheggio</label>
    <input type="checkbox" class="checkbox-filter" name="extra" value="Parcheggio" id="">
    <label for="checkbox"><i class="fas fa-swimmer extra_icon"></i>Piscina</label>
    <input type="checkbox" class="checkbox-filter" name="extra" value="Piscina" id="">
    <label for="checkbox"><i class="fas fa-concierge-bell extra_icon"></i>Portineria</label>
    <input type="checkbox" class="checkbox-filter" name="extra" value="Portineria" id="">
    <label for="checkbox"><i class="fas fa-hot-tub extra_icon"></i>Sauna</label>
    <input type="checkbox" class="checkbox-filter" name="extra" value="Sauna" id="">     
</div>
<div class="col-xs-12 col-md-4 wrap_button">
        <button class="btn btn_filters"type="submit" id="filter-button">Filtra</button>
        <button class="btn btn_filters"type="submit" id="remove-filters">Rimuovi Filtri</button>
</div>
</div>
        
   
</div>
  {{-- fine extras --}}
         </div>      
        </div>
                       {{-- filtra risultati jquery --}}
              

        <div class="container-fluid container-sponsored">
        <div class="row">
        @foreach ($sponsoredHouses as $housePromo)
        <div class="col-lg-4 col-sm-6 col-xs-12">
    
            <div class="card card_box">
                <div class="sponsored">Sponsored</div>
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
          <div class="container-fluid">
            <h2>Case</h2>
           <div class="row house-results">   
                   @foreach ($houses as $house)
       <div class="col-lg-4 col-sm-6 col-xs-12 house">
            <div class="card house card_box">
                <div class="img_container">
                    <img src="{{asset('storage/'.$house->img_path)}}" class="card-img-top img" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate">{{$house->address}}</h5>
                    <p class="card-text card_text"><i class="fas fa-home"></i>Area: {{$house->mq}} mq</p>
                    <p class="card-text card_text"><i class="fas fa-door-open"></i>Camere: {{$house->room_number}}</p>
                    <p class="card-text card_text"><i class="fas fa-toilet"></i>N° Bagni: {{$house->bathroom}}</p>
                    <p class="card-text card_text"><i class="fas fa-bed"></i>Posti letto: {{$house->bed}}</p>
                    <div class="extras">
                    @foreach ($house->extras as $extra)
                        {{$extra->name}}
                    @endforeach
                </div>
                    <a href="{{route('house.show', $house->id)}}" class="btn btn_look">Vedi Appartamento</a>
                </div>
                   @endforeach
        </div>   
        </div>  
    </div>
</div>


  

  
    
        {{-- risultati dalla home da cancellare quando si fa chiamata api --}}
      

    
        
    
    
    
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
                <div class="house">
            <div class="col-lg-4 col-sm-6 col-xs-12">    
              
            <div class="card card_box">
                <div class="img_container">
                    <img src="{{ url('storage/')}}/@{{ img_path }}" class="card-img-top img" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate">@{{address}}</h5>
                    <p class="card-text card_text"><i class="fas fa-home"></i>Area: @{{mq}}</p>
                    <p class="card-text card_text"><i class="fas fa-door-open"></i>Camere: @{{room_number}}</p>
                    <p class="card-text card_text"><i class="fas fa-toilet"></i>N° Bagni: @{{bathroom}}</p>
                    <p class="card-text card_text"><i class="fas fa-bed"></i>Posti letto: @{{bed}}</p>
                    <div class="extras">
                @{{extra}}
                </div>
                    <a href="http://127.0.0.1:8000/show/@{{id}}" class="btn btn_look">Mostra appartamento</a>
                </div>
                </div>
            
            </div>
            </div>
        </script>
 

</main>
@endsection

@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/search.js')}}"></script>
    <script src="{{asset('js/filter.js')}}"></script>
@endsection