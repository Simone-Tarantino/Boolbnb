@extends('layouts.layout')
@extends('layouts.app')
@section('main')
@foreach ($houses as $house)
@if (Auth::id()==$house->user_id)
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
            <li><a href="{{route('admin.houses.show', $house)}}">Mostra appartamento</a></li>
            <li><h3>Servizi extra</h3></li>
            @foreach ($house->extras as $extra)
            <li>{{$extra->name}}</li>
            
            @endforeach
        
            <form action="{{route('admin.houses.destroy', $house->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Cancella</button>
            </form>
        </li>
        </ul>
        @endif
    @endforeach    
@endsection