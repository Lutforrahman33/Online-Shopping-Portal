@extends('main_layouts.master')

@section('content')
   <div class="container margin-top-20">
   	    @if(App\Cart::totalItem() > 0)
              
                  <h2> My cart</h2>
       <table class="table table-bordered table-stripe">
        <tr>
          <th>Serial</th>
          <th>Title</th>
          <th>Product Image</th>
          <th>Product Quantity</th>
          <th>Unit price</th>
          <th>Total price</th>
          <th>Delete</th>
        </tr>
         <tbody>
              @php
               $total=0;
              @endphp

      @foreach(App\Cart::totalCart() as $cart)
          <tr>
            <td> {{ $loop->index+1 }} </td>
            <td>
                   <a href="{{ route('pages.product.show' , $cart->product->slug) }}">{{ $cart->product->title }}</a>
             </td>
            <td> 
                   @if($cart->product->images->count()>0)
                   <img src="{{ asset('images/products/'. $cart->product->images->first()->image) }}" width="40">
                   @endif
             </td>
                <td> 
                       <form class="form-inline" action="{{ route('carts.update' , $cart->id) }}" method="post">
                        @csrf
                            <input type="number" name="product_quantity" class="form-control" value="{{ $cart->product_quantity }}" />
                            <button type="submit" class="btn btn-success">Update</button>
                      </form>
                 </td>
                <td> {{ $cart->product->price }} tk </td>
                <td> {{ $cart->product->price * $cart->product_quantity }} tk </td>
                <td> 
                        <form class="form-inline" action="{{ route('carts.delete' , $cart->id) }}" method="post">
                        @csrf
                            <input type="hidden" name="cart_id" />
                            <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                </td>
          </tr>
                      @php
                      $total += ($cart->product->price * $cart->product_quantity);
                     @endphp
      @endforeach

              <tr>
                 <td colspan="4"></td>
                 <td>
                   Total Amount
                 </td>
                 <td colspan="2">
                    <strong>  {{ $total  }} Tk</strong>
                 </td>

              </tr>
         </tbody>  
                 
       </table>
             <div class="float-right">
               <a href="{{ route('products') }}" class="btn btn-info btn-lg">Shop More</a>
               <a href="{{ route('checkouts') }}" class="btn btn-warning btn-lg">Checkout</a>
             </div>
        @else
            <h2>No item</h2>
            <a href="{{ route('products') }}" class="btn btn-info btn-lg"> Go 
            Shopping</a>
        @endif
          
   </div>

@endsection       


	        