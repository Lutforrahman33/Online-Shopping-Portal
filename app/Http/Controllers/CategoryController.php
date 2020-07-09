<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Image;
use File;

class CategoryController extends Controller
{   
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
   // category create

    public function create(){

    	$main_categories = Category::orderBy('name' , 'desc')->where('parent_id' , NULL)->get();

    	return view('admin.category.create' , compact('main_categories'));
    }

     //category show

     public function show(){
         
          $categories = Category::orderBy('id' , 'desc')->get();
    	return view('admin.category.show' , compact('categories'));
    	
    }

    //category store

     public function store(Request $request){

    	$request->validate([

            'name'   => ['required' , 'max:100'],
            'description' => ['required' ,'max:255'],
            'image' =>['nullable'],
            
          ]);

    	 $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
     

        if($request->hasFile('image')){

        	
              $image = $request->file('image');
        	  $img = time() .'.'. $image->getClientOriginalExtension();
              $location = public_path('images/categories/' .$img);
              Image::make($image)->save($location);
              $category->image = $img;


        }

        $category->save();
        return redirect()->route('admin.categories');

    }
  
   //category edit
    
    public function category_edit($id){
         
         $main_categories = Category::orderBy('name' , 'desc')->where('parent_id' , NULL)->get();
         $category = category::find($id);

        return view('admin.category.edit' , compact('category' , 'main_categories'));
        
    }
       //category update

     public function category_update(Request $request , $id){

        $request->validate([

            'name'   => ['required' , 'max:100'],
            'description' => ['required' ,'max:255'],
            'image' =>['nullable'],
            
          ]);

        $category = category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
     

        if($request->hasFile('image')){

               if(File::exists('images/categories/' .$category->image)){
              File::delete('images/categories/' .$category->image);
            
            }
              $image = $request->file('image');
              $img = time() .'.'. $image->getClientOriginalExtension();
              $location = public_path('images/categories/' .$img);
              Image::make($image)->save($location);
              $category->image = $img;


        }

        $category->save();
        return redirect()->route('admin.categories');

    }

    //category delete with sub-category delete

    public function category_delete($id){
        
        $category = category::find($id);
        
        if($category != NULL){

            if($category->parent_id == NULL){
             $sub_categories = Category::orderBy('name' , 'desc')->where('parent_id' , $category->id)->get();
             
             foreach ($sub_categories as $sub) {

              if(File::exists('images/categories/' .$sub->image)){
              File::delete('images/categories/' .$sub->image);
            
            }
               $sub->delete();
             }

            }

           if(File::exists('images/categories/' .$category->image)){
              File::delete('images/categories/' .$category->image);
            
            }
          $category->delete();
        }
        return back();
    }
}
