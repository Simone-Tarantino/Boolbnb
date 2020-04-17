@extends('layouts.app')

@section('content')
<div class="main container-fluid">
    <div class="search">
        <form action="">
            <input type="text" name="" id="">
            <button class="btn btn-primary" type="submit">Cerca</button>
        </form>
    </div>
    <div class="sposored">
        <h2>Case in evidenza:</h2>
        <div class="appartaments">
           @foreach ($houses as $house)
                @if($house->status == 1)
                    <h2>Numero appartamento {{$house->id}}, pubblicato da {{$house->user_id}}</h2>
                    <ul>
                        <li>Numero Stanze:{{$house->room_number}}</li>
                        <li>Numero Letti: {{$house->bed}}</li>
                        <li>Numero Bagni:{{$house->bathroom}}</li>
                        <li>Metri Quadri Appartamento: {{$house->mq}}</li>
                        <li>Indirizzo: {{$house->address}}</li>
                        <li>Foto: {{$house->img_path}}</li>
                        <li>Caricato il:{{$house->created_at}}</li>
                        <li>Modificato il: {{$house->updated_at}}</li>
                        @if ($house->status == 1)
                            <li>Pubblicato: Si</li> 
                        @else 
                            <li>Pubblicato: no</li>
                        @endif
                        <li><a href="{{route('houses.show', $house)}}">Mostra appartamento</a></li>
                        {{-- <li><h3>Servizi extra</h3></li>
                        @foreach ($house->extras as $extra)
                            <li>{{$extra->name}}</li>
                        @endforeach --}}
                    </ul>
                @endif
            @endforeach          
        </div>
    </div>
</div>
@endsection
