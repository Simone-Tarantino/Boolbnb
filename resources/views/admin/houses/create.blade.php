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
 <div class="slogan">
     <h2>Diventa un host Boolbnb e inizia a guadagnare</h2>
 </div>
    <span>Raccontaci qualcosa sul tuo alloggio</span>
    <form action="{{route('admin.houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <li>
            <label for="room_number">Numero di stanze:</label>
            <input type="number" id="room_number" name="room_number" min="1" max="5" placeholder="Inserisci numero di stanze">
        </li>
        <li>
            <label for="bed">Numero di letti:</label>
            <input type="number" id="bed" name="bed" min="1" max="10" placeholder="Inserisci numero di letti">
        </li>
        <li><label for="bathroom">Numero di bagni:</label>
            <input type="number" id="bathroom" name="bathroom" min="1" max="5" placeholder="Inserisci numero di bagni">
        </li>
        <li><label for="description">Descrizione:</label>
            <input type="text" name="description" id="description">
        </li>
        <li><input type="number" id="mq" name="mq" step="any" min="50" max="900" placeholder="Inserisci il n. di mq"></li>
        {{-- Input ricerca indirizzo API tomtom per ricavare lat/long --}}
        <li>Inserisci l'indirizzo:<input type="text" class="address-input" name="" placeholder="Cerca Indirizzo"></li>
        <button class="search" type="submit">Cerca</button>
        <div class="results">
        </div>

        <li><input id="address" type="text" name="address"  value="" readonly placeholder="Indirizzo"></li>
        <li><input id="address-lat" type="text"  name="latitude" id="" value="" readonly placeholder="latitudine"></li>
        <li><input id="address-long" type="text" name="longitude" id="" value="" readonly placeholder="longitudine"></li>


        {{-- /// --}}

        <li><input type="file" name="img_path" accept="image/*"></li>
        <li><select name="status">
            <option value="0">Non pubblicato</option>
            <option value="1">Pubblicato</option>
        </select></li>

        <div class="form-group">
          <label for="extras">extras</label>
          @foreach ($extras as $extra)
          <div>
            <span>{{$extra->name}}</span>
            <input type="checkbox" name="extras[]" value="{{$extra->id}}">
          </div>
          @endforeach
        </div>

        <button type="submit">Crea</button>
    </button>

    <script id="entry-template" type="text/x-handlebars-template">
            <div class="entry-result">
                <div class="indirizzo">
                    <p>@{{address}}</p>
                    <ul class="coord">
                        <input class="lat" type="text" value="@{{latitude}}" name="" id="" readonly>
                        <input class="long" type="text" value="@{{longitude}}" name="" id="" readonly>
                    </ul>
                </div>
            </div>
        </script>
</div>
@endsection

@section('footer')
    <div class="footer">
        <div class="container footer_top">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>INFORMAZIONI</h5></li>
                        <li>Diversità e appartenenza</li>
                        <li>Boolbnb Citizen</li>
                        <li>Accessibilità</li>
                        <li>Newsroom</li>
                        <li>Affidabilità e Sicurezza</li>
                    </ul>                  
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>COMMUNITY</h5></li>
                        <li>Boolbnb Magazine</li>
                        <li>Opportunità di Lavoro</li>
                        <li>Boolbnb for Work</li>
                        <li>Invita degli amici</li>
                    </ul>                  
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>OSPITA</h5></li>
                        <li>Diventa Host</li>
                        <li>Proponi un' esperienza</li>
                        <li>Olimpiadi</li>
                        <li>Affittare Responsabilmente</li>
                        <li>Centro Risorse</li>
                    </ul>                  
                </div>
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><h5>ASSISTENZA</h5></li>
                        <li>Centro Assistenza</li>
                        <li>Servizio di assistenza di quartiere</li>    
                    </ul>                  
                </div>
            </div>
        </div>
            <div class="container footer_bottom">
                <div class="row">
                    <div class="col-md-7">
                        <p>© 2020 Boolbnb, Inc. All rights reserved  ·  Privacy  ·  Termini  ·  Mappa del sito  ·  Dettagli dell'azienda</p>
                    </div>
                    <div class="col-md-5 footer_bottom_right">
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-facebook-f"></i>
                    </div>
                </div>
            </div>
    </div>
@endsection

{{-- SCRIPT --}}
@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
@endsection