@extends('main_layouts.master')

@section('content')


 <!-- content  -->
 <div class="container margin-top-20">

                  <div class="row">
                    <div class="col-md-4">
                       @include('parts.sidebar')
                    </div>
                  

                    <div class="col-md-8">
                       <div class="widget">
                           <h3> Products in {{ $category->name }}</h3>
                                 @php
                                     $products = $category->products;
                                 @endphp
                           <div class="row">
                            @foreach($products as $product)

                              <div class="col-md-3">
                                <div class="card">
                                 
                                  @php
                                  $i=1;
                                  @endphp
                                 
                                  @foreach($product->images as $image)
                                    @if($i>0)
                                     <img class="card-img-top feature-img" src="{{ asset('images/products/'. $image->image) }}" alt="{{ $product->title }}">
                                    @endif
                                   
                                  @php
                                  $i--;
                                  @endphp
                                  @endforeach 
                                   

                                  
                                  <div class="card-body">
                                    <h4 class="card-title">
                                    <a href="{{ route('pages.product.show' , $product->slug) }}">{{ $product->title }}</a>  
                                    </h4>
                                    <p class="card-text">{{ $product->price }}</p>
                                    @include('parts.cart-button')
                                  </div>
                                </div>
                              </div>
                               
                             @endforeach  
                           </div>

                       </div>  

                    </div>
                </div>
            </div>
         
         <!-- end content-->

@endsection