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

Route::get('/home', 'HomeController@index')->name('home');  

Route::get('/add-user', 'CrudController@index')->name('add.user');
Route::post('/save-user', 'CrudController@create')->name('save.user'); 
Route::any('/edit-user/{user_id}', 'CrudController@edit')->name('edit.user'); 
Route::any('/update-user/{user_id}', 'CrudController@update')->name('update.user'); 
Route::any('/delete-user/{user_id}', 'CrudController@destroy')->name('delete.user'); 



// 


