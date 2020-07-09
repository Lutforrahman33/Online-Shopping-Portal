<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  ///product and category view manage

Route::get('/', 'PageController@index')->name('index');
Route::get('/contact', 'PageController@contact')->name('contact');
Route::get('/product/{slug}', 'PageController@slug_view')->name('pages.product.show');
Route::get('/product', 'PageController@products')->name('products');
Route::get('/search', 'PageController@search')->name('search');



Route::group(['prefix' => 'admin'] , function(){
  
      // admin login
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
    Route::post('/logout/submit', 'Auth\Admin\LoginController@logout')->name('admin.logout');

    //product manage
   Route::get('/', 'AdminPageController@index')->name('admin.index');
   Route::get('/product/create', 'AdminPageController@create')->name('admin.product.create');
   Route::get('/products', 'AdminPageController@product_show')->name('admin.products');
   Route::post('/product/store', 'AdminPageController@store')->name('admin.product.store');
   Route::get('/product/edit/{id}', 'AdminPageController@product_edit')->name('admin.product.edit');
   Route::post('/product/update/{id}', 'AdminPageController@product_update')->name('admin.product.update');  
   Route::post('/product/delete/{id}', 'AdminPageController@product_delete')->name('admin.product.delete');

     ///category manage
   Route::get('/category/create', 'CategoryController@create')->name('admin.category.create');
   Route::post('/category/store', 'CategoryController@store')->name('admin.category.store');
   Route::get('/categories', 'CategoryController@show')->name('admin.categories');
   Route::get('/category/edit/{id}', 'CategoryController@category_edit')->name('admin.category.edit');
   Route::post('/category/update/{id}', 'CategoryController@category_update')->name('admin.category.update');  
   Route::post('/category/delete/{id}', 'CategoryController@category_delete')->name('admin.category.delete');

      ///orders manage
  
     Route::get('/orders', 'OrderController@index')->name('admin.orders');
     Route::get('/orders/show/{id}', 'OrderController@show')->name('admin.orders.show');
    
     Route::post('/orders/delete/{id}', 'OrderController@delete')->name('admin.orders.delete');

  
     Route::post('/orders/complete/{id}', 'OrderController@complete')->name('admin.orders.completed');



});


Route::get('/product/category/{id}', 'ProductController@show')->name('pages.categories.show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//user profile manage
Route::group(['prefix' => 'user'] , function(){

 Route::get('/dashboard' , 'UserController@dashboard')->name('user.dashboard');
 Route::get('/profile' , 'UserController@profile')->name('user.profile');
 Route::post('/profile/update' , 'UserController@update')->name('user.update');


});

// cart item manage

Route::group(['prefix' => 'cart'] , function(){

 Route::get('/' , 'CartController@index')->name('carts');
 
 Route::post('/store' , 'CartController@store')->name('carts.store');
 Route::post('/update/{id}' , 'CartController@update')->name('carts.update');
 Route::post('/delete/{id}' , 'CartController@delete')->name('carts.delete');


});

// user buy product manage

Route::group(['prefix' => 'checkout'] , function(){

 Route::get('/' , 'CheckoutController@index')->name('checkouts');
 
 Route::post('/store' , 'CheckoutController@store')->name('checkouts.store');


});
