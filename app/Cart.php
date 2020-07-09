<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    public $fillable =[
     'user_id',
     'product_id',
     'product_quantity' , 'order_id'

    ];

    public function user(){

    	return $this->belongsTo('App\User');
    }

    public function product(){

    	return $this->belongsTo('App\Product');
    }

    public function order(){

    	return $this->belongsTo('App\Order');
    }

  // count the total item in the cart

    public static function totalItem(){

        if(Auth::check()){
            $carts = Cart::where('user_id' , Auth::id())->where('order_id' , NULL)->get();
              
              $total = 0;
              foreach($carts as $cart){

                $total += $cart->product_quantity;
              }
        }

        return $total;
    }

  // count the total value of the cart
    
    public static function totalCart(){

        if(Auth::check()){
            $carts = Cart::where('user_id' , Auth::id())->where('order_id' , NULL)->get();
              
            return $carts;      
        }

        
    }

}
