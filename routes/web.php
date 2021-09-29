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
// trang chu admin
Route::get('/admin', function () {
    return view('admin.home');
});
// trang category admin
Route::prefix('/admin/categories')->group(function () {
    Route::get('/',[
        'as'=> 'categories.index',
        'uses' => 'categoryController@index'
    ]);
    Route::get('/create',[
        'as'=> 'categories.create',
        'uses' => 'categoryController@create'
    ]);
    Route::post('/store',[
        'as'=> 'categories.store',
        'uses' => 'categoryController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'categories.edit',
        'uses' => 'categoryController@edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'categories.update',
        'uses' => 'categoryController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'categories.delete',
        'uses' => 'categoryController@delete'
    ]);
    Route::post('/search',[
        'as'=> 'categories.search',
        'uses' => 'categoryController@search'
    ]);
    Route::post('/autocomplete_search',[
        'as'=> 'categories.autocomplete_search',
        'uses' => 'categoryController@autocomplete_search'
    ]);
});
