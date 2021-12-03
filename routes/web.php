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

// 一般
Route::group(['middleware' => ['auth']], function() {
    Route::get('/my_page', 'Auth\LoginController@showMypage')->name('my_page');
});
Route::get('/index', 'HomeController@index')->name('index');
Route::get('/login', 'Auth\LoginController@showLogin')->name('login');
Route::get('/logout', 'Auth\LoginController@showLogout')->name('logout');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/new_account_edit', 'Auth\RegisterController@showNewAccountEdit')->name('new_account_edit');
Route::post('/new_account_edit', 'Auth\RegisterController@validateNewAccount');
Route::get('/new_account_conf', 'Auth\RegisterController@showNewAccountConf')->name('new_account_conf');
Route::post('/new_account_conf', 'Auth\RegisterController@sendConfForm');
Route::get('/new_account_done', 'Auth\RegisterController@showNewAccountDone')->name('new_account_done');

// 管理
Route::group(['middleware' => 'auth:admin'], function() {
    Route::get('/admin/top', 'ProductController@showTop')->name('admin_top');
    Route::get('/admin/product_list', 'ProductController@showProductList')->name('admin_product_list');
    Route::get('/admin/product_edit', 'ProductController@showProductEdit')->name('admin_product_edit');
    Route::post('/admin/product_edit', 'ProductController@sendEditForm');
    Route::get('/admin/product_conf', 'ProductController@showProductConf')->name('admin_product_conf');
    Route::post('/admin/product_conf', 'ProductController@sendConfForm');
    Route::get('/admin/product_done', 'ProductController@showProductDone')->name('admin_product_done');
    Route::delete('/admin/product_list/{product}', 'ProductController@productDelete');
});
Route::get('/admin/login', 'Admin\AdminLoginController@showLogin')->name('admin_login');
Route::get('/admin/logout', 'Admin\AdminLoginController@showLogout')->name('admin_logout');
Route::post('/admin/login', 'Admin\AdminLoginController@login');


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
