@extends('layouts.layout')
{{-- @extends('layouts.app') --}}
@section('main')

    <!-- Braintree -->
<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
    <form action="{{route("admin.pay")}}" method ="POST">
        @csrf
        @method("POST")
        <select name="payment" id="">

            <option  value="2">Standard 2.99</option>

            <option  value="3">Plus 5.99</option>

            <option  value="4">Premium 9.99</option>
        </select>

        <input type="hidden" name="id" value = "{{$house->id}}">
        <div class="container">
     <div class="row">
       <div class="col-md-8 col-md-offset-2">
         <div id="dropin-container"></div>
         <button type="submit" id="submit-button">Request payment</button>
       </div>
     </div>
  </div>

    </form>
  <script>
    var button = document.querySelector('#submit-button');
    braintree.dropin.create({
      authorization: "sandbox_s9cpwv6d_7q3bydbjsbv3fhzh",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('{{ route('payment.process') }}', {payload}, function (response) {
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

@endsection

