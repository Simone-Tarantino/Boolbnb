@extends('layouts.layout')
{{-- @extends('layouts.app') --}}
@section('main')
<div class="main_show">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-6" id="houseShow">
                <img class="img_show" src="{{asset('storage/'.$house->img_path)}}" alt="">
                <h2 class="address-map">{{$house->address}}</h2>
                <ul class="list-inline extra">
                    <li class="list-inline-item"><i class="fas fa-home option_icon"></i>{{$house->mq}} mq</li>
                    <li class="list-inline-item"><i class="fas fa-door-open option_icon "></i>{{$house->room_number}} camere</li>
                    <li class="list-inline-item"><i class="fas fa-bed option_icon"></i>{{$house->bed}} Posti letto</li>
                    <li class="list-inline-item"><i class="fas fa-toilet option_icon"></i>{{$house->bathroom}} bagni</li>
                </ul>
                <ul class="list-inline">
                    @if ($house->status == 1)
                    <li class="list-inline-item">Questo appartamento è pubblicato</li>
                    @else
                    <li class="list-inline-item">Questo appartamento non è pubblicato</li>
                    @endif
                </ul>
                <h4>DESCRIZIONE</h4>
                <p>{{$house->description}}</p>

                <div class='coord-lat d-none' value="{{$house->latitude}}">{{$house->latitude}}</div>
                <div class='coord-lon d-none' value="{{$house->longitude}}">{{$house->longitude}}</div>
                {{-- bottoni precedenti --}}
                {{-- @if($house->user_id == Auth::user()->id)
                <a class="btn btn_show" href="{{route('admin.houses.edit', $house)}}">Modifica dati</a>
                @endif
                @if($house->user_id == Auth::user()->id)
                <a class="btn btn_show" href="{{route('admin.sponsor',$house->id)}}">Sponsorizza</a>
                @endif --}}

                <ul class="list_extra">
                    <li><h4>SERVIZI</h4>
                    @foreach ($house->extras as $extra)
                    <li>{{$extra->name}}</li>
                    @endforeach
                </ul>
                {{-- nuova posizione bottoni --}}
                 @if($house->user_id == Auth::user()->id)
                <a class="btn btn_show" href="{{route('admin.houses.edit', $house)}}">Modifica dati</a>
                @endif
                @if($house->user_id == Auth::user()->id)
                <a class="btn btn_show" href="{{route('admin.sponsor',$house->id)}}">Sponsorizza</a>
                @endif
                {{-- fine bottoni --}}

                {{-- nuova map --}}
                <div id="map"></div>
                {{-- fine nuova map --}}
            </div>{{--  /col --}}
            <div class="col-sm-12 col-md-10 col-lg-6 card_container">
                <h3>Le Tue Case</h3>
                @foreach ($houseFiltered as $item)
                        @if ($house->id != $item->id)
                        <div class="card card_box">
                            <img src="{{asset('storage/'.$item->img_path)}}" class="card-img-top img" alt="...">
                            <div class="card-body">
                                <h4 class="card-text">APPARTAMENTO</h4>
                                <p class="card-text card_text">{{$item->address}}</p>
                                @if ($item->status == 1)
                                    <p class="card-text">Pubblicato</p>
                                @else
                                    <p class="card-text">Non Pubblicato</p>
                                @endif
                            </div>
                            <div class="btn_zone">
                                <a class="btn btn_look" href="{{route('admin.houses.show', $item)}}" role="button">Mostra</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>{{--  /col --}}
            {{-- vecchia mappa --}}
            {{-- <div class="col-md-12 col-lg-6">
                <div id="map"></div>
            </div> --}}
            {{-- fine vecchia mappa --}}
        </div>
        {{--  /row --}}
    </div>
    {{--  /container --}}
</div>
{{--  /main-show --}}
@endsection



@section('scripts')
    <script src="{{asset('js/map.js')}}"></script>
@endsection