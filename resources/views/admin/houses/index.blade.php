@extends('layouts.layout')
{{-- @dd($sponsoredHouses) --}}
@section('main')
<div class="main">
    <div class="container main_admin_index">
        <div class="title">
        <h1>Ciao {{(empty(Auth::user()->name)) ? (Auth::user()->email) : (Auth::user()->name)}} Bentornato </h1>
        </div>
        <div class="row"> 
            @foreach ($houses as $house)
            @if (Auth::id()==$house->user_id)
            <div class="col-lg-4 box col-md-6 col-sm-12 col-xs-12">
                <div class="card card_box">
                    @foreach ($sponsoredHouses as $item)
                    @if ($house->id == $item->id)
                        <div class="sponsored">
                            <p>Sponsored</p>
                        </div>
                    @endif
                    @endforeach 
                    <img src="{{asset('storage/'.$house->img_path)}}" class="card-img-top img" alt="...">
                    <div class="card-body">
                        <h4 class="card-text">APPARTAMENTO</h4>
                        <p class="card-text card_text">{{$house->address}}</p>
                        @if ($house->status == 1)
                        <p class="card-text">Pubblicato</p>
                        @else
                        <p class="card-text">Non Pubblicato</p>
                        @endif
                        @foreach ($sponsoredHouses as $item)
                    @if ($house->id == $item->id)
                         <p class="card-text">PROMOZIONE FINO AL: {{$item->sponsors[0]->pivot->created_at->addHour($item->sponsors[0]->duration)}}</p>  
                    @endif
                    @endforeach 
                    </div>
                    <div class="btn_zone">
                        <a class="btn btn_look" href="{{route('admin.houses.show', $house)}}" role="button">Mostra</a>    
                        <form action="{{route('admin.houses.destroy', $house->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn_danger" type="submit">Cancella</button>
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



{{-- SCRIPT --}}
@section('scripts')        
    <script src="{{asset('js/app.js')}}"></script>
@endsection