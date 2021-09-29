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

Route::get('/', 'HomeController@index');

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/logout', 'AuthController@logout');

Route::post('/login', 'AuthController@login');

// Route Room
Route::get('/rooms', 'RoomsController@index');
Route::get('/rooms/create', 'RoomsController@create');
Route::post('/rooms/store', 'RoomsController@store');
Route::get('/rooms/edit/{id_kamar}', 'RoomsController@edit');
Route::post('/rooms/update/{id_kamar}', 'RoomsController@update');
Route::delete('/rooms/delete/{id_kamar}', 'RoomsController@destroy');

//Route Report
Route::get('/report', 'ReportController@index');
Route::get('/getChart/{year}/{week}', 'ReportController@chartReport');
Route::post('/report/checkin/{id_booking}', 'ReportController@checkin');


// Route Product
Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::post('/products/store', 'ProductController@store');
Route::get('/products/edit/{product_id}', 'ProductController@edit');
Route::post('/products/update/{product_id}', 'ProductController@update');
Route::delete('/products/delete/{product_id}', 'ProductController@delete');

// Route Gallerty 
Route::get('/gallery', 'GalleryController@index');
Route::get('/gallery/create', 'GalleryController@create');
Route::post('/gallery/store', 'GalleryController@store');
Route::delete('/gallery/delete/{upload_path}', 'GalleryController@delete');

// Route Billing
Route::get('/billing', 'BillingController@index');
