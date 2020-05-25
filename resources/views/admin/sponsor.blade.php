@extends('layouts.layout')
{{-- @extends('layouts.app') --}}

@section('main')
    <!-- Braintree -->
<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
<main>
  
  <div class="container payment-container">
    <div class="row">
      <div class="col-md-12">
        <h1>Sponsorizza il tuo appartamento</h1>
        
        <form action="{{route("admin.pay")}}" method ="POST">
            @csrf
            @method("POST")            
            <div class="container plan-container">
              <div class="row">
                <div class="col-md-12 plan-card-col">
                  @foreach ($sponsors as $sponsor)

                    <div class="card plan-standard-card">
                      <div class="card-body">
                        <h4 class="card-title">{{$sponsor["name"]}}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">EUR {{$sponsor["price"]}}</h6>
                        <p class="card-text">{{$sponsor["description"]}}</p>
                        <a href="#" class="card-link">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="plan-standard" value="{{$sponsor["id"]}}" checked>
                          </div>
                        </a>              
                      </div>                
                    </div>
                      
                  @endforeach
                
                  
                </div>
              </div>          
            </div>

            <input type="hidden" name="id" value = "{{$house->id}}">
            <div id="dropin-container"></div>
            <div class="button-container-submit">
              <button type="submit" id="submit-button" class="btn btn-send">Invia</button> 
            </div>
           
        </form>
      </div>
    </div>
  </div>
  <script>
    var button = document.querySelector('#submit-button');
    braintree.dropin.create({
      authorization: "sandbox_s9cpwv6d_7q3bydbjsbv3fhzh",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('{{ route('admin.payment.process') }}', {payload}, function (response) {
            if (response.success) {
              alert('Payment successfull!');
            } else {
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });
  </script>
</main>
@endsection

