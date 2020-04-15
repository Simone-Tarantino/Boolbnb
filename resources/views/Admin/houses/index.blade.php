@extends('layouts.layout')
@extends('layouts.app')
@section('main')
@foreach ($houses as $house)
@if (Auth::id()==$house->user_id)
    <h2>Numero appartamento {{$house->id}}, pubblicato da {{$house->user_id}}</h2>
        <ul>
            <li>{{$house->room_number}}</li>
            <li>{{$house->bed}}</li>
            <li>{{$house->bathroom}}</li>
            <li>{{$house->mq}}</li>
            <li>{{$house->address}}</li>
            <li>{{$house->img_path}}</li>
            <li>{{$house->created_at}}</li>
            <li>{{$house->updated_at}}</li>
            <li>{{$house->status}}</li>
            <li><a href="{{route('admin.houses.show', $house)}}">Mostra appartamento</a></li>
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