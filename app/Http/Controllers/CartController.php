<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use Auth;

class CartController extends Controller
{
    public function index(){
    
    	return view('carts.index');
    }
  
    //storing cart item

    public function store(Request $request){
       
       
       
      $cart = Cart::orWhere('user_id' , Auth::id())
                    ->where('product_id' , $request->product_id)
                    ->where('order_id' , NULL)
                    ->first();

       if($cart != NULL){
          
          
        $cart->increment('product_quantity');

       }else{


       $cart = new Cart;
       if(Auth::check()){
       $cart->user_id = Auth::id();
       }

       $cart->product_id = $request->product_id;
       $cart->save();

       
      }

      return back();
    }

    //updating cart item

     public function update(Request $request , $id){
     
      $cart = Cart::find($id);
      if($cart != NULL)
      {
        $cart->product_quantity = $request->product_quantity;
      }else{
      
       return redirect()->route('carts');
      }
       $cart->save();
      return back();
    }

   //deleting cart item

    public function delete($id){
        $cart = Cart::find($id);
        if($cart != NULL){
        
        $cart->delete();
        }else{
          return redirect()->route('carts');
        }
        return back();
           
    }

}
