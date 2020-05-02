@extends('layouts.layout')

{{-- @extends('layouts.app') --}}

@section('main')
<div class="main_show">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <img class="img_show" src="{{asset('storage/'.$house->img_path)}}" alt="">
                <h2 class="address-map">{{$house->address}}</h2>
                <ul class="list-inline extra">
                    <li class="list-inline-item">{{$house->mq}} mq</li>
                    <li class="list-inline-item">{{$house->room_number}} camere</li>
                    <li class="list-inline-item">{{$house->bed}} posti letti</li>
                    <li class="list-inline-item">{{$house->bathroom}} bagni</li>
                </ul>
                <h4>DESCRIZIONE</h4>
                <p>{{$house->description}}</p>
                <div class='coord-lat d-none' value="{{$house->latitude}}">{{$house->latitude}}</div>
                <div class='coord-lon d-none' value="{{$house->longitude}}">{{$house->longitude}}</div>

                {{-- CONTATTA --}}
                <a class="btn btn-primary btn_show" href="{{route('contactus', $house)}}">Contatta l' Host</a>
                 {{-- MAPPA --}}
                <div id="map"></div>
            </div>{{--  /col --}} 
            <div class="col-md-6 calendar-container">
                <div class="calendar">
                <div class="calendar__picture">
                    <h2>5, Tuesday</h2>
                    <h3>May</h3>
                </div>
                <div class="calendar__date">
                    <div class="calendar__day">M</div>
                    <div class="calendar__day">T</div>
                    <div class="calendar__day">W</div>
                    <div class="calendar__day">T</div>
                    <div class="calendar__day">F</div>
                    <div class="calendar__day">S</div>
                    <div class="calendar__day">S</div>
                    <div class="calendar__number"></div>
                    <div class="calendar__number"></div>
                    <div class="calendar__number"></div>
                    <div class="calendar__number">1</div>
                    <div class="calendar__number">2</div>
                    <div class="calendar__number">3</div>
                    <div class="calendar__number">4</div>
                    <div class="calendar__number calendar__number--current">5</div>
                    <div class="calendar__number">6</div>
                    <div class="calendar__number">7</div>
                    <div class="calendar__number">8</div>
                    <div class="calendar__number">9</div>
                    <div class="calendar__number">10</div>
                    <div class="calendar__number">11</div>
                    <div class="calendar__number">12</div>
                    <div class="calendar__number">13</div>
                    <div class="calendar__number">14</div>
                    <div class="calendar__number">15</div>
                    <div class="calendar__number">16</div>
                    <div class="calendar__number">17</div>
                    <div class="calendar__number">18</div>
                    <div class="calendar__number">19</div>
                    <div class="calendar__number">20</div>
                    <div class="calendar__number">21</div>
                    <div class="calendar__number">22</div>
                    <div class="calendar__number">23</div>
                    <div class="calendar__number">24</div>
                    <div class="calendar__number">25</div>
                    <div class="calendar__number">26</div>
                    <div class="calendar__number">27</div>
                    <div class="calendar__number">28</div>
                    <div class="calendar__number">29</div>
                    <div class="calendar__number">30</div>
                </div>
                </div>
            </div> 
        </div>{{--  /row --}} 
    </div>{{--  /container --}}
</div>{{--  /main --}}


@endsection

@section('scripts')
    <script src="{{asset('js/map.js')}}"></script>
@endsection