<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;

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


Route::group(['namespace'=>'Front'],function (){
    Route::get('/','indexController@indexShow');
    Route::get('search/{search}','indexController@searchItem');

});
Route::group(['namespace'=>'Admin'],function(){
   Route::group(['prefix'=>'admin','middleware'=>'checklogin'],function(){
      Route::get('/','indexController@indexShow');

       Route::group(['prefix'=>'category'],function (){
           Route::get('/','categoryController@listAll');
           Route::post('/','categoryController@addItem');
           Route::get('update','categoryController@updateItem');
           Route::get('delete/{id}','categoryController@deleteItem');
       });
       Route::group(['prefix'=>'product'],function(){
            Route::get('/','productController@listAll');
            Route::get('add','productController@addShow');
            Route::post('add','productController@addItem');
            Route::get('update/{id}','productController@updateShow');
            Route::post('update/{id}','productController@updateItem');
            Route::get('delete/{id}','productController@deleteItem');
       });
   });







   //-------------------------------------------
   Route::group(['prefix'=>'login','middleware'=>'checklogout'],function(){
       Route::get('/','indexController@showLogin');
       Route::post('/','indexController@checkLogin');
    });
   Route::get('logout','indexController@logout');
   Route::get('register','indexController@showRegister');
   Route::post('register','indexController@register');
});
