@extends('layouts.layout')
@extends('layouts.app')
@section('main')
<div class="main">
    <div class="container main_admin_index">
        <div class="title">
        <h2>Ciao {{(empty(Auth::user()->name)) ? (Auth::user()->email) : (Auth::user()->name)}} Bentornato </h2>
        </div>
        <div class="row"> 
            @foreach ($houses as $house)
            @if (Auth::id()==$house->user_id)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card box">
                <img src="{{asset('storage/' . $house->img)}}" class="card-img-top img" alt="...">
                <div class="card-body">
                    <h4 class="card-text">APPARTAMENTO</h4>
                    <p class="card-text">{{$house->address}}</p>
                    @if ($house->status == 1)
                    <p class="card-text">Pubblicato</p>
                    @else
                    <p class="card-text">Non Pubblicato</p>
                    @endif
                    <div class='coord-lat d-none' value="{{$house->latitude}}">{{$house->latitude}}</div>
                    <div class='coord-lon d-none' value="{{$house->longitude}}">{{$house->longitude}}</div>
                </div>
                <div class="btn_zone">
                    <a class="btn btn-primary btn_look" href="{{route('admin.houses.show', $house)}}" role="button">Mostra</a>    
                    <form action="{{route('admin.houses.destroy', $house->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Cancella</button>
                    </form>
                </div>
            </div>
            </div>
            @endif
            @endforeach    
        </div>
    </div>
</div>
@endsection

{{-- FOOTER --}}
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