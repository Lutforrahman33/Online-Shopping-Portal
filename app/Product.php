<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{  
	public $fillable = [
        'category_id', 'title', 'description' , 'price', 'quantity', 'slug' , 'title',
    ];
     
     public function images(){

     	return $this->hasMany('App\ProductImage');
     }

     public function category(){

     	return $this->belongsTo('App\Category');
     }

}





