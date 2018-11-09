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



Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();
 Route::group(['middleware' => 'auth'], function () {
Route::get('/', 'CategoryController@index');

Route::get('/create','CategoryController@create');
Route::get('/edit/{id}','CategoryController@edit');
Route::get('/update/{id}','CategoryController@update');
Route::get('/destroy/{id}','CategoryController@destroy');
Route::get('/product/{id}','ProductController@index');
Route::post('/Pcreate/{id}','ProductController@create');
Route::get('/option/{id}','OptionController@show');
Route::get('/option/create/{id}','OptionController@show');
});
Route::get('/user', 'CategoryController@show');


Route::get('/Uproduct/{id}','ProductController@show');
Route::get('/Unewses/{id}','NewsController@store');
Route::get('/addcart/{id}','ProductController@addcart');
Route::get('/cart','ProductController@cart');
Route::get('/delcart/{id}','ProductController@delcart');
Route::get('/updateCart/{id}/{val}','ProductController@updateCart');
Route::get('/updateSelect/{id}/{val}','ProductController@updateSelect');
Route::get('/updateCheckbox/{id}/{val}','ProductController@updateCheckbox');
Route::get('/order','OrderController@order');
Route::get('/send','MailController@send');
Route::get('/more/{id}','ProductController@more');
Route::post('/AddCart/{id}','CartController@AddCart');
Route::get('nopay',function(){
	return view('order');
});
Route::get('/map',function(){
	return view('map');
});
