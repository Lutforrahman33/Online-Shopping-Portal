<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id){

     $category = Category::find($id);
     if($category != NULL){
     	return view('pages.category_show' , compact('category'));
     }
     else{
     	 return back();
     }


    }
}
