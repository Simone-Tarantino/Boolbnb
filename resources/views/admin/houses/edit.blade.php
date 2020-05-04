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
  <img src="https://a0.muscache.com/pictures/7ad2b738-cda0-468f-abe1-2fba843c3425.jpg" alt="Diventa un host">
</div>
    <div class="slogan">
        <h2>Modifica i tuoi dati per l'attività da host</h2>
    </div>
    {{-- <div class="little_slogan">
        <span>Raccontaci qualcosa sul tuo alloggio</span>
    </div> --}}
    
    <form action="{{route('admin.houses.update', $house)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
     <div class="row">
      <div class="col-xs-12 col-md-6 card shadow p-3 mb-5 bg-white rounded">
          <div class="card-header little_slogan"><span>Raccontaci le modifiche del tuo alloggio</span></div>
        {{-- Form stanze --}}
        <div class="form-group row create_room">
            <label for="room_number" class="col-sm-3 col-form-label">Stanze</label>
            <div class="col-sm-2 col-md-3 col-lg-2">
                 <input class="form-control"  type="number" id="room_number" name="room_number" min="1" max="5" value="{{(!empty($house)) ?$house->room_number : ''}}" placeholder="Inserisci numero di stanze">
                {{-- <input type="number" id="room_number" name="room_number" min="1" max="5" placeholder="Inserisci numero di stanze"> --}}
            </div>
        </div>

        {{-- Form letti --}}
        <div class="form-group row">
            <label for="bed" class="col-sm-3 col-form-label">Letti</label>
            <div class="col-sm-2 col-md-3 col-lg-2">
                <input class="form-control" type="number" id="bed" name="bed" min="1" max="10" value="{{(!empty($house)) ?$house->bed : ''}}" placeholder="Inserisci numero di letti">
            {{-- <input type="number" id="bed" name="bed" min="1" max="10" placeholder="Inserisci numero di letti"> --}}
            </div>
        </div>

        {{-- Form bagni --}}
        <div class="form-group row">
            <label for="bathroom" class="col-sm-3 col-form-label">Bagni</label>
            <div class="col-sm-2 col-md-3 col-lg-2">
                <input class="form-control" type="number" id="bathroom" name="bathroom" min="1" max="5" value="{{(!empty($house)) ?$house->bathroom : ''}}" placeholder="Inserisci numero di bagni">
                
            </div>
        </div>


        {{-- Form Descrizione --}}
        <div class="form-group row">
            <label for="description" class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-form-label">Descrizione</label>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-6">
                {{-- <li><label for="description">Descrizione</label>
                  <input type="text" name="description" id="description">
                </li> --}}
                {{-- <input type="text" class="form-control"   name="description" value="{{(!empty($house)) ?$house->description : ''}}" placeholder="Descrizione"> --}}
                <textarea type="text" class="form-control" id="description" name="description" rows="4" value="{{(!empty($house)) ?$house->description : ''}}">{{(!empty($house)) ?$house->description : ''}}</textarea>
            </div>   
        </div>

        

        
        {{-- Form Metratura --}}
        <div class="form-group row">
            <label for="mq" class="col-sm-3 col-form-label">Metri</label>
            <div class="col-sm-2 col-md-3">
                <input class="form-control" type="number" id="mq" name="mq" step="any" min="50" max="900" value="{{(!empty($house)) ?$house->mq : ''}}" placeholder="Inserisci il n. di mq">
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
                        <input type="text" class="address-input form-control" name="address" value="{{(!empty($house)) ?$house->address : ''}}" placeholder="Modifica l'indirizzo">
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
                        <input id="address-up" type="text" class='indirizzo form-control' name="address" id="address" value="{{(!empty($house)) ?$house->address : ''}}" readonly placeholder="Indirizzo">
                </div>
                
                </div>
                
                
                {{-- Risultati delle cordinate nascoste --}}
                <li class="d-none"><input id="address-lat-up" type="text"  name="latitude" value="{{(!empty($house)) ? $house->latitude : ''}}" readonly placeholder="latitudine"></li>
                <li class="d-none"><input id="address-long-up" type="text" name="longitude" value="{{(!empty($house)) ? $house->longitude : ''}}" readonly placeholder="longitudine"></li>


    
        


        {{-- /// --}}

        {{-- Input Inserimento immagine --}}
          {{-- <input type="file" name="img_path" accept="image/*"> --}}

          <div class="form-group row">
            <label for="img_path" class="col-sm-3 col-md-12 col-lg-3 col-form-label">Immagine</label>
            <div class="col-sm-6 col-md-4 col-lg-6">
                <input type="file" name="img_path" accept="image/*" value="{{(!empty($house)) ?$house->img_path : ''}}">
            </div>
         </div>






        {{-- Form status --}}
        <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="ol-sm-4 col-md-5 col-lg-4">
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
            <input type="checkbox" name="extras[]" value="{{$extra->id}}" {{($house->extras->contains($extra->id)) ? 'checked' : ''}}>
          </div>
          @endforeach

          </div>
          
        </div>

        <button class="btn btn_search" type="bottom submit">Modifica</button>
   </div>
 <div class="col-xs-10 col-md-4 box_text ">
            <h3>Risorse utili</h3> 
            <p>
                In quanto host, la community di Boolbnb ti assiste sempre. Per ricevere dei consigli utili, puoi visitare il Centro Assistenza, entrare in contatto con 375.000 host nel Community Center e usufruire di diversi toolkit per gli host.
            </p>
            <h3>Siamo qui per te 24 ore su 24</h3> 
            <p>
                Il nostro team globale è a tua disposizione 24 ore su 24, 7 giorni su 7, via telefono, email e chat. Può assisterti per tutte le questioni che vanno dalla creazione del tuo annuncio ai problemi con gli ospiti.
            <h3>Il tuo spazio, le tue regole</h3>
            <p>
                Per far sapere cosa bisogna aspettarsi, puoi aggiungere delle regole della casa che gli ospiti dovranno accettare prima di prenotare, ad esempio restrizioni sul fumo e sulle attività.
                Se dopo aver prenotato un ospite viola una di queste regole, potrai cancellare la prenotazione.
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