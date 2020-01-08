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

#Parent Category 
Route::get('/add-parent-category', 'ParentCategory@add_parent_category');
Route::get('/list-parent-category', 'ParentCategory@list_parent_category');

Route::post('/save-parent-category', 'ParentCategory@save_parent_category');

Route::get('/unactive-parent-category/{parent_category_id}', 'ParentCategory@unactive_parent_category');
Route::get('/active-parent-category/{parent_category_id}', 'ParentCategory@active_parent_category');

Route::get('/edit-parent-category/{parent_category_id}', 'ParentCategory@edit_parent_category');
Route::get('/delete-parent-category/{parent_category_id}', 'ParentCategory@delete_parent_category');

Route::post('/update-parent-category/{parent_category_id}', 'ParentCategory@update_parent_category');

#Brand Product
Route::get('/add-brand-product', 'BrandController@add_brand_product');
Route::get('/list-brand-product', 'BrandController@list_brand_product');

Route::post('/save-brand-product', 'BrandController@save_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'BrandController@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandController@active_brand_product');

Route::get('/edit-brand-product/{brand_product_id}', 'BrandController@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandController@delete_brand_product');

Route::post('/update-brand-product/{brand_product_id}', 'BrandController@update_brand_product');
