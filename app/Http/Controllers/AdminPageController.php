<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Image;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){

    	return view('admin.index');
    }
    
    //product Create

    public function create(){

    	return view('admin.product.create');
    }

    //product store

    public function store(Request $request){

    	$request->validate([

            'title'   => ['required' , 'max:100'],
            'description' => ['required' ,'max:255'],
            'price' => ['required'],
            'quantity' => ['required'],
            'category_id' => ['required'],
          ]);

    	$product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title ,'-');

        $product->category_id = $request->category_id;
        $product->brand_id = 1;
        $product->admin_id = 1;

        $product->save();

      

        if($request->hasFile('product_image')){

        	foreach ($request->file('product_image') as $image) {

        	  $img = time() .'.'. $image->getClientOriginalExtension();
              $location = public_path('images/products/' .$img);
              Image::make($image)->save($location);

            $product_image = new ProductImage;
            $product_image->product_id = $product->id;
            $product_image->image = $img;
            $product_image->save();

        	}

        }
        return redirect()->route('admin.products');

    }

    //viewing product

    public function product_show(){
         
          $products = Product::orderBy('id' , 'desc')->get();
    	return view('admin.show' , compact('products'));
    	
    }

    //editing product

     public function product_edit($id){
         
         $product = Product::find($id);
    	return view('admin.product.edit' , compact('product'));
    	
    }

    //update product

     public function product_update(Request $request, $id){
         
         $request->validate([

            'title'   => ['required' , 'max:100'],
            'description' => ['required' ,'max:255'],
            'price' => ['required'],
            'quantity' => ['required'],
            'category_id' => ['required'],
          ]);

    	$product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title ,'-');

        $product->category_id = $request->category_id;
        $product->brand_id = 1;
        $product->admin_id = 1;

        $product->save();

      
        return redirect()->route('admin.products');
    	
    }

    //delete product

    public function product_delete($id){
         
          $product = Product::find($id);
       
          $product->delete();
      

    	return back();
    	
    }

}
