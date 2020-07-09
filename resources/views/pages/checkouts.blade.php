@extends('main_layouts.master')

@section('content')
   <div class="container margin-top-20">
   	
   	 <div class="card card-body">
   		 <h2> My Iteams</h2>
         </hr>
         <div class="row">
         	<div class="col-md-7">
         		      @foreach(App\Cart::totalCart() as $cart)
                      <p>{{ $cart->product->title }} -  {{ $cart->product->price }} Tk - {{ $cart->product_quantity }} item</p>
                      @endforeach
                      <a href="{{ route('carts') }}">Change Carts</a>
         	</div>
         	<div class="col-md-5">
                      @php
                      $total = 0;
                      @endphp
         		      @foreach(App\Cart::totalCart() as $cart)
                       @php
                       $total += ($cart->product->price * $cart->product_quantity);
         		       @endphp
         		      @endforeach
         		      <p> Total price : {{ $total }} Tk </p>
         		      <p> Total price with delivery cost : {{ $total + App\Settings::first()->shipping_cost  }} Tk</p>
         	</div>

         </div>
   	 </div>

   	  <div class="card card-body mt-2">
   		 <h2>Delivery Address</h2>
         </hr>
          
              
                    <form method="POST" action="{{ route('checkouts.store') }}">
                        @csrf

                        

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->first_name. ' '.Auth::user()->last_name  :'' }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Num:') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ Auth::check() ? Auth::user()->phone_number  : ''  }}" required autocomplete="phone_number">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address:') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ Auth::check() ? Auth::user()->address  : ''  }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method:') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="payment_method_id" required>
                                  <option value="">select a payment method</option>
                                 @foreach($payments as $payment)
                                      <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                 @endforeach
                                </select>
                            </div>
                        </div>

                         
                          <div class="form-group row">
                            <label for="transection_id" class="col-md-4 col-form-label text-md-right">{{ __('Transection Id(Bikash/Rocket):') }}</label>

                            <div class="col-md-6">
                                <input id="transection_id" type="text" class="form-control" name="transection_id" value=" ">

                                
                            </div>
                        </div>
                        
                  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Order Now') }}
                                </button>
                            </div>
                        </div>
                    </form>
                



   	  </div>

   </div>

@endsection       