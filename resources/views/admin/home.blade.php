@extends('layouts.layout')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Il tuo log-in è stato effettuato correttamente!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection