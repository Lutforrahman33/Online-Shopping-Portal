<?php

namespace App; 

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    
    public function parent(){

    	return $this->belongsTo(Category::class , 'parent_id');
    }

     public function products(){

    	return $this->hasMany(Product::class);
    }

   //Finding the parent or subcategory

    public static function ParentOrNot($parent_id , $child_id){

    	$categories = Category::where('id' , $child_id)->Where('parent_id' , $parent_id)->get();

    	if($categories != NULL){
    		return true;
    	}else{
    		return flase;
    	}
    }
}
