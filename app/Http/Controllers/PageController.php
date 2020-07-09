<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //viewing product in index page for user 

    public function index(){

        $products = Product::orderBy('id' , 'desc')->get();
    	return view('pages.index' , compact('products'));
    }

    //Site contact page

    public function contact(){

    	return view('pages.contact');
    }
     
     //viewing product in product page
     public function products(){
         
          $products = Product::orderBy('id' , 'desc')->get();
    	return view('pages.product.product_index' , compact('products'));
    }

    //viewing single product using slug

    public function slug_view($slug){
         
          $product = Product::where('slug' , $slug)->first();
          if($product != NULL)
          {
            return view('pages.product.show' , compact('product')); 
          }
          
          else{
        return redirect()->route('pages.index');
        }

    }

    // searching for a product

     public function search(Request $request){
           
        $search = $request->search;
        $products = Product::Where('title' , 'like' , '%'.$search.'%')->orWhere('description' , 'like' , '%'.$search.'%')->orderBy('id' , 'desc')->paginate(5);
        return view('pages.search' , compact('search' ,'products'));
    }

}
