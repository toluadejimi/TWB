@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',[
'title'=>__('Buy Log'),
'buttons'=>[
[

]
]])
@endsection
@section('content')
<div class="row justify-content-center">
   <div class="col-12">


      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      @if (session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
      @endif
      @if (session()->has('error'))
      <div class="alert alert-danger">
          {{ session()->get('error') }}
      </div>
      @endif
      
      
      <div class="card card-stats">
         <!-- Card body -->
         <div class="card-body">
            <div class="row">
               <div class="col">
                 
                  <h5 class="card-title text-uppercase text-muted mb-2">Welcome {{ Auth::user()->name }}, </h5>

                  <p> Buy Google Voice, Talkatone, Text-Now etc logs now</p>
               </div>
               <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                     <i class="fas fa-server"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>



      <div class="row">


         <div class="col-xl-6 col-md-6">

         
            <div class="card card-stats">
               <!-- Card body -->
               <div class="card-body">

                  <h4 class=" mb-5 my-3">Buy Google Voice/ Textnow & Talkatone Log</h4>


                  <form action="buy-now" method="post">
                     @csrf 

                     <div class="row">

                     <div class="col-xl-6 col-md-6">
                        <div class="form-group mb-3">
                           <label>Choose Item</label>
                           <select id="country-dropdown"  required name="product" class="form-control">
                              <option value="">-- Select Item --</option>
                              @foreach ($products as $data)
                              <option value="{{$data->item_id}}">
                                 {{$data->item_name}}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-xl-6 col-md-6">


                        <div class="form-group mb-3">
                           <label>Choose Area Code</label>
                           <select id="state-dropdown" rwquired name="area_code" class="form-control">
                           </select>



                        </div>

                     </div>
                     <div class="col-xl-6 col-md-6">


                     
                        <div class="form-group">
                           <label>Amount (NGN)</label>
                           <select id="city-dropdown" required name="amount" class="form-control">
                           </select>
                        </div>
                        

                     </div>

                     {{-- <div class="col-xl-6 col-md-6">


                        <div class="form-group mb-3">
                           <label>Quantity</label>
                           <input type="number" name="qty[]" id="qty" value="1" required class="form-control">
                           </select>
                        </div>

                     </div> --}}

                     <div class="col-xl-6 col-md-6">

                       {{-- <div class="my-1">
                           <p >Total Price: <strong id="totalPrice">NGN 0</strong></p>
                        </div> --}}

                        <div>
                           <button type="submit" class="btn btn-outline-primary my-4 submit-button float-left">{{ __('Buy Now') }}</button>
                        </div>
                     </div>


                  </div>

                  </form>


                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                  <script>
                     $(document).ready(function () {
                     
                               /*------------------------------------------
                               --------------------------------------------
                               Country Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#country-dropdown').on('change', function () {
                                   var item_id = this.value;
                                   $("#state-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-code')}}",
                                       type: "POST",
                                       data: {
                                            item_id: item_id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (result) {
                                          console.log(result)
                                           $('#state-dropdown').html('<option value="">-- Select Area Code --</option>');
                                           $.each(result.states, function (key, value) {
                                               $("#state-dropdown").append('<option value="' + value
                                                   .id + '">' + value.area_code + '</option>');
                                           });
                                           $('#city-dropdown').html('<option value="">-- Amount --</option>');
                                       }
                                   });
                               });
                     
                               /*------------------------------------------
                               --------------------------------------------
                               State Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#state-dropdown').on('change', function () {
                                   var id = this.value;
                                   $("#city-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-amount')}}",
                                       type: "POST",
                                       data: {
                                           id: id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (res) {
                                          console.log(res)
                                           $('#city-dropdown').html(res.price);
                                           $.each(res.cities, function (key, value) {
                                               $("#city-dropdown").append('<option value="' + value.price + '">' + value.price + '</option>');
                                           });
                                       }
                                   });
                               });
                     
                           });
                  </script>


                  <script>
                     var quantityInput = document.getElementById("qty");
                     var totalPriceElement = document.getElementById("totalPrice");
                     var amount = document.getElementById("city-dropdown");

                 
                     quantityInput.addEventListener("change", updateTotalPrice);
                 
                     function updateTotalPrice() {
                       var quantity = parseInt(quantityInput.value);
                       var price = parseInt(amount.value); // Example price per item
                       var totalPrice = quantity * price;
                       console.log(totalPrice);
                       console.log(price);
                       console.log(amount);

                       totalPriceElement.textContent = "NGN " + totalPrice;
                     }
                  </script>



               </div>
            </div>
         </div>

         {{-- <div class="col-xl-6 col-md-6">


            <div class="card card-stats">
               <!-- Card body -->
               <div class="card-body">
                  <div class="row">
                     <div class="col">

                        <h4 class=" mb-5 my-3">Buy Netflix Log</h4>


                        <form>

                           <div class="form-group mb-3">

                              <label>Choose Item</label>
                              <select id="netp" class="form-control">
                                 <option value="">-- Select Item --</option>
                                 @foreach ($netflix_p as $data)
                                 <option value="{{$data->item_id}}">
                                    {{$data->item_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>

                           <div class="form-group mb-3">
                              <label>Amount (NGN)</label>
                              <select id="net-amount" class="form-control">
                              </select>
                           </div>

                           <div class="form-group mb-3">
                              <label>Quantity</label>
                              <input type="number" name="qty" id="qty" value="1" required class="form-control">
                              </select>
                           </div>

                        </form>


                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                           $(document).ready(function () {
                     
                               /*------------------------------------------
                               --------------------------------------------
                               Country Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#netp').on('change', function () {
                                   var item_id = this.value;
                                   $("#net-amount").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-code')}}",
                                       type: "POST",
                                       data: {
                                            item_id: item_id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (result) {
                                          console.log(result)
                                           $('#net-amount').html(result.price);
                                           $.each(result.states, function (key, value) {
                                               $("#net-amount").append('<option value="' + value
                                                   .id + '">' + value.price + '</option>');
                                           });
                                           $('#city-dropdown').html('<option value="">-- Amount --</option>');
                                       }
                                   });
                               });
                     
                               /*------------------------------------------
                               --------------------------------------------
                               State Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#state-dropdown').on('change', function () {
                                   var id = this.value;
                                   $("#city-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-amount')}}",
                                       type: "POST",
                                       data: {
                                           id: id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (res) {
                                          console.log(res)
                                           $('#city-dropdown').html(res.price);
                                           $.each(res.cities, function (key, value) {
                                               $("#city-dropdown").append('<option value="' + value
                                                   .id + '">' + value.price + '</option>');
                                           });
                                       }
                                   });
                               });
                     
                           });
                        </script>


                     </div>
                     <div class="col-auto">


                     </div>
                  </div>
               </div>



            </div>


         </div> --}}

      </div>



   </div>


   <div class="mt-4 alert alert-success">
                                                Note: Buy clicking on buy you have agreed with our terms of service / Replacemnt.
                                                <br>
                                                <br>
                                                Terms: All logs been uploaded to our platform is been tested before uploaded, therefore we only replace logs that the password is incorrect. Replacement is been done within 1 hour of the logs in your hands.
                                                <br>
                                                <br>
                                                Logs we replace: Gmail Google voice,  TEXTNOW, Domain Google voice, Talkatone 
                                                <br>
                                                <br>
                                                Knowledge: If you get a TEXTNOW logs, try to login directly from the TEXTNOW App or Login using Google account.
                                                <br>
                                                If your Gmail google voice get disabled, kindly request a review from Google they will unblock it for you within 1 to 2 days
                                            </div>

</div>

<input type="hidden" id="base_url" value="{{ url('/') }}">
@endsection
@push('js')
<script src="{{ asset('assets/js/pages/user/device.js') }}"></script>
@endpush