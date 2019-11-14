<?php

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


Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'web'],function (){
    Route::any('login','LoginController@login');
    Route::any('login_out','LoginController@loginOut');
    Route::get('code','LoginController@code');
});
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'web'],function (){

    Route::get('index.html','IndexController@index');
    Route::get('welcome','IndexController@welcome');
    Route::any('change_password','IndexController@changePassword');
    Route::resource('article','ArticleController');


    Route::get('category/edit_end/{id}','CategoryController@editEnd');
    Route::post('category/search','CategoryController@search');
    Route::post('category/status','CategoryController@status');
    Route::resource('category','CategoryController');


    Route::resource('commodity','CommodityController');

});









