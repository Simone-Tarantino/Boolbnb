@extends('layouts.app')

@section('content')
<div class="main container-fluid">
    <div class="search">

        <form method="POST">

       <input type="text" name="address" id="address">
    
        <button class="btn_search" id="filter-button" type="submit">Search</button>

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
