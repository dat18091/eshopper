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