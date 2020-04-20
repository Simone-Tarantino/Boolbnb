@extends('layouts.app')

@section('content')
<div class="main container-fluid">
    <div class="search">
        <form action="">
            <input type="text" name="" id="">
            <button class="btn btn-primary" type="submit">Cerca</button>
        </form>
    </div>
    @foreach ($distances as $distanceKey => $distance)
    @foreach ($houses as $houseKey => $house)
        @if ($distance <= 20 && $distanceKey == $houseKey)
              {{$house->address}}
              <br>
              {{$distance}}
              <br>
              @endif
    @endforeach
    @endforeach
              
@endsection
