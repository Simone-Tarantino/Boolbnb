<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="refresh" content="2;url=http://127.0.0.1:8000/admin/houses" />
    {{-- FONT-AWESOME
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    {{-- TOM-TOM-MAP --}}
    <title>{{ config('app.name') }}</title>
</head>
<main>
    <div class="container main redirect">
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
                        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        Il tuo accesso è stato effettuato correttamente! <br>
                        Verrai reindirizzato ai tuoi appartamenti
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>      
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>