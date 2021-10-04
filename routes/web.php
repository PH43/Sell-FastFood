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
//Route::get('/admin', function () {
//        return view('admin.home');
//});

Route::get('/admin', 'AdminController@index');

Route::get('/login_admin', [
    'as'=> 'admins.admin_login',
    'uses' => 'AdminController@login_admin']);
Route::post('/', [
        'as'=> 'admins.post_login',
        'uses' => 'AdminController@post_login'
    ]);
Route::get('/log_out', [
    'as'=> 'admins.log_out',
    'uses' => 'AdminController@log_out'
]);
Route::get('/register', [
    'as'=> 'admins.show_form_register',
    'uses' => 'AdminController@show_form_register'
]);
Route::post('/post_register', [
    'as'=> 'admins.register',
    'uses' => 'AdminController@register'
]);

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

//trang product admin
Route::prefix('/admin/products')->group(function () {
    Route::get('/',[
        'as'=> 'products.index',
        'uses' => 'productController@index'
    ]);
    Route::get('/create',[
        'as'=> 'products.create',
        'uses' => 'productController@create'
    ]);
    Route::post('/store',[
        'as'=> 'products.store',
        'uses' => 'productController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'products.edit',
        'uses' => 'productController@edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'products.update',
        'uses' => 'productController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'products.delete',
        'uses' => 'productController@delete'
    ]);
    Route::post('/search',[
        'as'=> 'products.search',
        'uses' => 'productController@search'
    ]);
});

//trang quan ly user
Route::prefix('/admin/user')->group(function () {
    Route::get('/',[
        'as'=> 'users.index',
        'uses' => 'userAdminController@index'
    ]);
    Route::get('/create',[
        'as'=> 'users.create',
        'uses' => 'userAdminController@create'
    ]);
    Route::post('/store',[
        'as'=> 'users.store',
        'uses' => 'userAdminController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'users.edit',
        'uses' => 'userAdminController@edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'users.update',
        'uses' => 'userAdminController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'users.delete',
        'uses' => 'userAdminController@delete'
    ]);
});
