{{-- @dd($extras); --}}

@extends('layouts.layout')
{{-- @extends('layouts.app') --}}

@section('main')

<div class=" container main_admin_create">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<div class="image_container">
  <img src="https://a0.muscache.com/pictures/5fb428c8-6829-43ee-ba1b-3c557791c73e.jpg" alt="Diventa un host">
</div>
    <div class="slogan">
        <h2>Diventa un host Boolbnb e inizia a guadagnare</h2>
    </div>
    {{-- <div class="little_slogan">
        <span>Raccontaci qualcosa sul tuo alloggio</span>
    </div> --}}
    
    <form action="{{route('admin.houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
     <div class="row">
      <div class="col-xs-12 col-md-6 card shadow p-3 mb-5 bg-white rounded">
          <div class="card-header little_slogan"><span>Raccontaci qualcosa sul tuo alloggio</span></div>
        {{-- Form stanze --}}
        <div class="form-group row create_room">
            <label for="room_number" class="col-sm-3 col-form-label">Stanze</label>
            <div class="col-sm-2 col-md-3 col-lg-2">
                {{-- <input type="number" id="room_number" name="room_number" min="1" max="5" placeholder="Inserisci numero di stanze"> --}}
                    <select class="custom-select mr-sm-2" id="room_number" name="room_number">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
            </div>
        </div>

        {{-- Form letti --}}
        <div class="form-group row">
            <label for="bed" class="col-sm-3 col-form-label">Letti</label>
            <div class="col-sm-2 col-md-3 col-lg-2">
            {{-- <input type="number" id="bed" name="bed" min="1" max="10" placeholder="Inserisci numero di letti"> --}}
            <select class="custom-select mr-sm-2" id="bed" name="bed">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            </div>
        </div>

        {{-- Form bagni --}}
        <div class="form-group row">
            <label for="bathroom" class="col-sm-3 col-form-label">Bagni</label>
            <div class="col-sm-2 col-md-3 col-lg-2">
                <select class="custom-select mr-sm-2" id="bathroom" name="bathroom">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>


        {{-- Form Descrizione --}}
        <div class="form-group row">
            <label for="description" class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-form-label">Descrizione</label>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-6">
                {{-- <li><label for="description">Descrizione</label>
                  <input type="text" name="description" id="description">
                </li> --}}
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>   
        </div>

        

        
        {{-- Form Metratura --}}
        <div class="form-group row">
            <label for="mq" class="col-sm-3 col-form-label">Metri</label>
            <div class="col-sm-2 col-md-3">
                <input type="number" class="form-control"  id="mq" name="mq" step="any" min="50" max="900">
                {{-- <li><input type="number" id="mq" name="mq" step="any" min="50" max="900" placeholder="Inserisci il n. di mq"></li> --}}
            </div>
        </div>

        
        

        {{-- Input ricerca indirizzo API tomtom per ricavare lat/long --}}
    
            {{-- <label for="address-input" class="col-sm-1 col-form-label">Inserisci l'indirizzo</label>
                <input type="text" class="address-input" class="col-sm-10" name="address-input" placeholder="Cerca Indirizzo">  
            <button class="search" type="submit">Cerca</button> --}}


           


        


                <div class="form-group-inline row">
                    <label for="address-input" class="col-sm-3 col-md-12 col-lg-3 col-form-label">Indirizzo</label>
                    <div class="col-sm-6 col-md-8 relative_address">
                        <input type="text" class="address-input form-control" name="address-input" placeholder="Cerca un indirizzo">
                         <div class="results_div">
                {{-- Risultati di handlebars --}}
                <div class="results container">
                </div>
            </div>
                    </div>
                    {{-- <button class="search" type="submit">Cerca</button> --}}

                </div>

                <div class="form-group row">
                <label for="address" class="col-sm-3 col-md-12 col-lg-3 col-form-label"></label>
                <div class="col-sm-6 col-md-8 address_hidden">
                        <input id="address" class="form-control" type="text" name="address"  value="" readonly placeholder="">
                </div>
                
                </div>
                
                
                {{-- Risultati delle cordinate nascoste --}}
                <li class="d-none"><input id="address-lat" type="text"  name="latitude" id="" value="" readonly placeholder="latitudine"></li>
                <li class="d-none"><input id="address-long" type="text" name="longitude" id="" value="" readonly placeholder="longitudine"></li>


    
        


        {{-- /// --}}

        {{-- Input Inserimento immagine --}}
          {{-- <input type="file" name="img_path" accept="image/*"> --}}

          <div class="form-group row">
            <label for="img_path" class="col-sm-3 col-md-12 col-lg-3 col-form-label">Immagine</label>
            <div class="col-sm-6 col-md-4 col-lg-6">
                <input type="file" name="img_path" accept="image/*">
            </div>
         </div>






        {{-- Form status --}}
        <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-4 col-md-5 col-lg-4">
                <select class="custom-select mr-sm-2" id="status" name="status">
                    <option value="1" selected>Pubblicato</option>
                    <option value="0">Non Pubblicato</option>
                </select>
            </div>
        </div>
        
        
        {{-- <li><select name="status">
            <option value="0">Non pubblicato</option>
            <option value="1">Pubblicato</option>
        </select></li> --}}


        {{-- Form Extras --}}
        <div class="form-group-inline row">
          <label for="extras" class="col-sm-3 col-md-3 col-lg-3 col-form-label">Servizi</label>

          <div class="extra_container">
              @foreach ($extras as $extra)
          <div class="extra_input">
            <span>{{$extra->name}}</span>
            <input type="checkbox" name="extras[]" value="{{$extra->id}}">
          </div>
          @endforeach

          </div>
          
        </div>

        <button class="btn btn_search" type="bottom submit">Crea</button>
   </div>
 <div class="col-xs-10 col-md-4 box_text ">
            <h3>Perché affittare su Boolbnb?</h3> 
            <p>
                Indipendentemente dal tipo di alloggio o stanza che vuoi condividere,
                Boolbnb rende semplice e sicuro ospitare dei viaggiatori. Spetta a te il controllo completo della disponibilità, dei prezzi, delle regole della casa e della modalità di interazione con gli ospiti.
            </p>
            <h3>Pubblica il tuo annuncio gratuitamente</h3> 
            <p>
                Pubblica qualsiasi alloggio senza addebiti di registrazione, da un salotto condiviso a una seconda casa e a tutto quello che c'è nel mezzo.
            <h3>Con noi sei al sicuro</h3>
            <p>
                Per tenere al sicuro te, il tuo alloggio e le tue cose, 
                tuteliamo ogni prenotazione con una protezione in caso di danni alla casa di 1.000.000 EUR e con un'altra assicurazione di pari valore contro gli incidenti.
            </p>

        </div>

</div>


    {{-- Script Handlebars --}}
    <script id="entry-template" type="text/x-handlebars-template">
            <div class="entry-result">
                <div class="indirizzo">
                    <p>@{{address}}</p>
                    <ul class="coord d-none">
                        <input class="lat" type="text" value="@{{latitude}}" name="" id="" readonly>
                        <input class="long" type="text" value="@{{longitude}}" name="" id="" readonly>
                    </ul>
                </div>
            </div>
        </script>
</div>
@endsection

@section('footer')
    
@endsection

{{-- SCRIPT --}}
@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
@endsection