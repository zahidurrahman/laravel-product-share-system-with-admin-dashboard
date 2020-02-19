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
Route::get('/services', function () {
    return view('user.services');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/', function () {
    return view('user.index');
});

Route::get('/about', function () {
    return view('user.about');
});
Route::get('/report', function () {
    return view('user.report');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/edit_profile', function () {
    return view('user.edit_profile');
});
Route::post('/edit_profile', 'HomeController@edit_profile')->name('edit_profile');
//user fann_get_cascade_activation_functions
Route::get('/product_list', function () {
    return view('user.product.product_list');
});
Route::post('/add_product', 'ProductController@store')->name('add_product');
Route::get('/product/{id}', 'ProductController@inactive_product')->name('product_inactive');
Route::get('/product_edit/{id}', 'ProductController@edit')->name('product_edit');
Route::post('/product_update', 'ProductController@update')->name('product_update');
Route::get('/product_del/{id}', 'ProductController@destroy')->name('product_delete');

Route::post('/add_order', 'OrderController@add_order')->name('order');
Route::get('/order_list', function () {
    return view('user.order_list');
});
Route::get('/manage_order', function () {
    return view('user.manage_order');
});
Route::get('/owner_mark_receive', function () {//give rating to buyer
    return view('user.rating.give_buyer_rating');
});

Route::get('/owner_mark_accept/{id}', 'OrderController@accept')->name('order_accept');
Route::get('/owner_mark_reject/{id}', 'OrderController@reject')->name('order_reject');


Route::post('/add_rating_to_buyer', 'RatingController@rate_to_buyer')->name('rate_to_buyer');


Route::get('/buyer_mark_borrow', function () {//give rating to owner
    return view('user.rating.give_owner_rating');
});
Route::post('/add_rating_to_owner', 'RatingController@rate_to_owner')->name('rate_to_owner');

Route::get('/single', function () {
    return view('user.single_product');
});
Route::post('/product_search', 'ProductController@product_search')->name('product_search');
//admin function
Route::get('/manage_user', function () {
    return view('admin.manage_user.user_list');
});
Route::get('/bann/{id}', 'HomeController@bann_user')->name('bann');
Route::get('/del_user/{id}', 'HomeController@del_user')->name('del_user');
