@extends('layouts.layout')

{{-- @extends('layouts.app') --}}

@section('main')
<div class="main_show">
    <div class="container">
        <div class="row">
            {{-- <div class="col-xs-12 col-md-7"> --}}
            <div class="col-xs-12 col-md-12 col-lg-6"id="houseShowGuest">
                <img class="img_show" src="{{asset('storage/'.$house->img_path)}}" alt="">
                <h2 class="address-map">{{$house->address}}</h2>
                {{-- parte dell'host vecchia --}}
                {{-- @if (!empty($house->user->name))
                    <p class="host_name">Host: {{$house->user->name}}</p>
                @else  
                    <p class="host_name">Host: {{$house->user->email}}</p>
                @endif --}}
                {{--  fine parte dell'host vecchia --}}
                <h4>DESCRIZIONE</h4>
                {{-- aggiunta if per descrizione vuota --}}
                {{-- <p>{{$house->description}}</p> --}}
                @if (!empty($house->description))
                    <p>{{$house->description}}</p>
                @else  
                    <p>Il Proprietario non ha aggiunto una descrizione dell'appartamento</p>
                @endif
                {{-- fine if per descrizione vuota --}}
                <div class='coord-lat d-none' value="{{$house->latitude}}">{{$house->latitude}}</div>
                <div class='coord-lon d-none' value="{{$house->longitude}}">{{$house->longitude}}</div>

                  {{-- parte dell'host NUOVA --}}
                @if (!empty($house->user->name))
                    <p class="host_name">HOST: <em>{{$house->user->name}}</em></p>
                @else  
                    <p class="host_name">HOST: <em>{{$house->user->email}}</em></p>
                @endif
                {{--  fine parte dell'host NUOVA --}}

                {{-- CONTATTA --}}
                <a class="btn btn_show" href="{{route('contactus', $house)}}">Contatta l'Host</a>
                 {{-- MAPPA --}}
            </div>{{--  /col --}} 
            {{-- <div class="col-xs-12 col-md-5"> --}}
            <div class="col-sm-12 col-md-10 col-lg-6">
                <div class="service_container">
                <div class="container">
                    <div class="row">
                    <div class="col-xs-12 col-md-12 card_box">
                        <div class="card_title">Tipo di Alloggio</div>
                        <ul class="list_box">
                            <li class="list_service"><i class="fas fa-home"></i><span>{{$house->mq}} mq</span></li>
                            <li class="list_service"><i class="fas fa-door-open"></i>{{$house->room_number}} camere</li>
                            <li class="list_service"><i class="fas fa-bed"></i>{{$house->bed}} letti</li>
                            <li class="list_service"><i class="fas fa-toilet"></i>{{$house->bathroom}} bagni</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-12 card_box">
                        <div class="card_title">Servizi</div>
                        <ul class="list_box">
                            @foreach ($house->extras as $extra)
                                @if ($extra->name == 'WiFi')
                                    <li class="list_service"><i class="fas fa-wifi"></i>{{$extra->name}}</li>
                                    @elseif($extra->name == 'Parcheggio')
                                        <li class="list_service"><i class="fas fa-parking"></i>{{$extra->name}}</li>      
                                    @elseif($extra->name == 'Piscina')
                                        <li class="list_service"><i class="fas fa-swimmer"></i>{{$extra->name}}</li>      
                                    @elseif($extra->name == 'Portineria')
                                        <li class="list_service"><i class="fas fa-concierge-bell"></i>{{$extra->name}}</li>      
                                    @elseif($extra->name == 'Sauna')
                                        <li class="list_service"><i class="fas fa-hot-tub"></i>{{$extra->name}}</li>      
                                @endif  
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
                </div>     
            </div> {{--  /col --}}
            <div class="col-md-12 col-lg-6">
                <div id="map"></div>
            </div>
        </div>{{--  /row --}} 
    </div>{{--  /container --}}
</div>{{--  /main --}}


@endsection

@section('scripts')
    <script src="{{asset('js/map.js')}}"></script>
@endsection