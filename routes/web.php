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

#Front End
Route::get('/', 'HomeController@Index');
Route::get('/trang-chu', 'HomeController@Index');

#Back End
Route::get('/admin', 'AdminController@Index');
Route::get('/dashboard', 'AdminController@show_dashboard');

Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

#Category Controller
Route::get('/add-category-product', 'CategoryController@add_category_product');
Route::get('/list-category-product', 'CategoryController@list_category_product');

Route::post('/save-category-product', 'CategoryController@save_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'CategoryController@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryController@active_category_product');

Route::get('/edit-category-product/{category_product_id}', 'CategoryController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryController@delete_category_product');

Route::post('/update-category-product/{category_product_id}', 'CategoryController@update_category_product');