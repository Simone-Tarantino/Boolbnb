@extends('layouts.layout')
@extends('layouts.app')
@section('main')
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
            <li><a href="{{route('admin.houses.edit', $house)}}">Modifica dati</a></li>
        </ul>
        <ul>
        @foreach ($house->extras as $extra)
        <li>{{$extra->name}}</li>
            
        @endforeach
        </ul>
@endsection