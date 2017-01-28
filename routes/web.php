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

Auth::routes();

Route::get('/home', 'HomeController@index');


//Logged in users/seller cannot access or send requests these pages
Route::group(['middleware' => 'seller_guest'], function() {

Route::get('seller_register', 'SellerAuth\RegisterController@showRegistrationForm');
Route::post('seller_register', 'SellerAuth\RegisterController@register');
Route::get('seller_login', 'SellerAuth\LoginController@showLoginForm');
Route::post('seller_login', 'SellerAuth\LoginController@login');

});


//Only logged in sellers can access or send requests to these pages
Route::group(['middleware' => 'seller_auth'], function(){

Route::post('seller_logout', 'SellerAuth\LoginController@logout');
Route::get('/seller_home', function(){
  return view('seller.home');
});

});
