<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //showing all order

    public function index(){

        $orders = Order::orderBy('id' , 'desc')->get();
    	return view('admin.orders.index' , compact('orders'));
    }

    //viewing single order

    public function show($id){

        $order = Order::find($id);
    	return view('admin.orders.show' , compact('order'));
    }

    //delete order

    public function delete($id){

        $order = Order::find($id);
        $order->delete();
    	return back();
    }

    //order confirmation

    public function complete($id){

        $order = Order::find($id);

        $order->is_seenByAdmin = 1;
        if($order->is_completed){
            
            $order->is_completed = 0;
            $order->is_paid = 0;
        }else{
            $order->is_completed = 1;
            
            $order->is_paid = 1;
        }

        $order->save();

        return back();
        }
    


}
