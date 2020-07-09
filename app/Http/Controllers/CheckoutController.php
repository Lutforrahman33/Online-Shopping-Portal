<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Order;
use Auth;
use App\Cart;

class CheckoutController extends Controller
{
    public function index(){

        $payments = Payment::orderBy('priority' , 'asc')->get();
    	return view('pages.checkouts' , compact('payments'));
    }

    // Buy product request

     public function store(Request $request){

         $this->validate($request ,[
           
           'name' => 'required' ,
           'Phone_number' => 'required' ,
           'address' => 'required' ,
           'payment_method_id' => 'required' ,


         ]);

        $order = new Order;

        if($request->payment_method_id == '3' || $request->payment_method_id == '5'){
        $order->transection_id = $request->transection_id;
        }
        

        $order->name = $request->name;
        $order->user_id = Auth::id();
       
        $order->phone_number = $request->phone_number;
        $order->delivery_address = $request->address;
        $order->payment_id = $request->payment_method_id;  

        $order->save();

        foreach (Cart::totalCart() as $cart) {
        	$cart->order_id = $order->id;
        	$cart->save();
        }
        
      	return redirect()->route('index');
    }
}
