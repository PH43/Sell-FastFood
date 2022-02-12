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
//Phần client
Route::get('/','HomeController@index');
Route::get('/product_by_category/{id}', [
    'as'=> 'homes.category_product',
    'uses' => 'HomeController@category_product']);
Route::get('/product_detail/{id}', [
    'as'=> 'homes.product_detail',
    'uses' => 'HomeController@product_detail']);
Route::post('/add_to_cart', [
    'as'=> 'homes.add_to_cart',
    'uses' => 'HomeController@add_to_cart']);
Route::get('/show_cart', [
    'as'=> 'homes.show_cart',
    'uses' => 'HomeController@show_cart']);
Route::get('/delete_cart/{id}', [
    'as'=> 'homes.delete_cart',
    'uses' => 'HomeController@delete_cart']);
Route::post('/update_cart_qty/{id}', [
    'as'=> 'homes.update_cart_qty',
    'uses' => 'HomeController@update_cart_qty']);
Route::post('/checkout', [
    'as'=> 'homes.checkout',
    'uses' => 'HomeController@checkout']);
Route::get('/search_home', [
    'as'=> 'homes.search_home',
    'uses' => 'HomeController@search_home']);
Route::post('/comment', [
    'as'=> 'homes.comment',
    'uses' => 'HomeController@comment']);

// trang chu admin


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
        'uses' => 'categoryController@index',
        'middleware' => 'can:category-list'
    ]);
    Route::get('/create',[
        'as'=> 'categories.create',
        'uses' => 'categoryController@create',
        'middleware' => 'can:category-add'
    ]);
    Route::post('/store',[
        'as'=> 'categories.store',
        'uses' => 'categoryController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'categories.edit',
        'uses' => 'categoryController@edit',
        'middleware' => 'can:category-edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'categories.update',
        'uses' => 'categoryController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'categories.delete',
        'uses' => 'categoryController@delete',
        'middleware' => 'can:category-delete'
    ]);
    Route::get('/search',[
        'as'=> 'categories.search',
        'uses' => 'categoryController@search'
    ]);
//    Route::get('/autocomplete_search',[
//        'as'=> 'categories.autocomplete_search',
//        'uses' => 'categoryController@autocomplete_search'
//    ]);
});

//trang product admin
Route::prefix('/admin/products')->group(function () {
    Route::get('/',[
        'as'=> 'products.index',
        'uses' => 'productController@index',
        'middleware' => 'can:product-list'
    ]);
    Route::get('/create',[
        'as'=> 'products.create',
        'uses' => 'productController@create',
        'middleware' => 'can:product-add'
    ]);
    Route::post('/store',[
        'as'=> 'products.store',
        'uses' => 'productController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'products.edit',
        'uses' => 'productController@edit',
        'middleware' => 'can:product-edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'products.update',
        'uses' => 'productController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'products.delete',
        'uses' => 'productController@delete',
        'middleware' => 'can:product-delete'
    ]);
    Route::get('/search',[
        'as'=> 'products.search',
        'uses' => 'productController@search'
    ]);
});

//trang quan ly user
Route::prefix('/admin/user')->group(function () {
    Route::get('/',[
        'as'=> 'users.index',
        'uses' => 'userAdminController@index',
        'middleware' => 'can:user-list'
    ]);
    Route::get('/create',[
        'as'=> 'users.create',
        'uses' => 'userAdminController@create',
        'middleware' => 'can:user-add'
    ]);
    Route::post('/store',[
        'as'=> 'users.store',
        'uses' => 'userAdminController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'users.edit',
        'uses' => 'userAdminController@edit',
        'middleware' => 'can:user-edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'users.update',
        'uses' => 'userAdminController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'users.delete',
        'uses' => 'userAdminController@delete',
        'middleware' => 'can:user-delete'
    ]);
//    Route::post('/update/{id}',[
//        'as'=> 'users.update',
//        'uses' => 'userAdminController@update'
//    ]);
    Route::get('/search',[
        'as'=> 'users.search',
        'uses' => 'userAdminController@search'
    ]);

});

//trang phan quyen
Route::prefix('/admin/roles')->group(function () {
    Route::get('/',[
        'as'=> 'roles.index',
        'uses' => 'roleAdminController@index',
        'middleware' => 'can:role-list'
    ]);
    Route::get('/create',[
        'as'=> 'roles.create',
        'uses' => 'roleAdminController@create',
        'middleware' => 'can:role-add'
    ]);
    Route::post('/store',[
        'as'=> 'roles.store',
        'uses' => 'roleAdminController@store'
    ]);
    Route::get('/edit/{id}',[
        'as'=> 'roles.edit',
        'uses' => 'roleAdminController@edit',
        'middleware' => 'can:role-edit'
    ]);
    Route::post('/update/{id}',[
        'as'=> 'roles.update',
        'uses' => 'roleAdminController@update'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'roles.delete',
        'uses' => 'roleAdminController@delete',
        'middleware' => 'can:role-delete'
    ]);
});
//trang order
Route::prefix('/admin/orders')->group(function () {
    Route::get('/',[
        'as'=> 'orders.index',
        'uses' => 'orderAdminController@index',
        'middleware' => 'can:order-list'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'orders.delete',
        'uses' => 'orderAdminController@delete',
        'middleware' => 'can:order-delete'
    ]);
    Route::get('/change_status/{id}',[
        'as'=> 'orders.change_status',
        'uses' => 'orderAdminController@change_status',
        'middleware' => 'can:order-confirm'
    ]);
    Route::post('/send_mail_confirm/{id}',[
        'as'=> 'orders.send_mail_confirm',
        'uses' => 'orderAdminController@send_mail_confirm'
    ]);
    Route::get('/show_form_reject/{id}',[
        'as'=> 'orders.show_form_reject',
        'uses' => 'orderAdminController@show_form_reject',
        'middleware' => 'can:order-reject'
    ]);
    Route::post('/send_mail_reject/{id}',[
        'as'=> 'orders.send_mail_reject',
        'uses' => 'orderAdminController@send_mail_reject'
    ]);
    Route::get('/ship/{id}',[
        'as'=> 'orders.ship',
        'uses' => 'orderAdminController@ship'
    ]);
    Route::get('/search',[
        'as'=> 'orders.search',
        'uses' => 'orderAdminController@search'
    ]);
});

//trang rating
//Route::prefix('/admin/ratings')->group(function () {
//    Route::get('/',[
//        'as'=> 'ratings.index',
//        'uses' => 'ratingAdminController@index'
//    ]);
//});
//comment
Route::prefix('/admin/comments')->group(function () {
    Route::get('/',[
        'as'=> 'comments.index',
        'uses' => 'commentAdminController@index',
        'middleware' => 'can:comment-list'
    ]);
    Route::get('/delete/{id}',[
        'as'=> 'comments.delete',
        'uses' => 'commentAdminController@delete',
        'middleware' => 'can:comment-delete'
    ]);
    Route::get('/search',[
        'as'=> 'comments.search',
        'uses' => 'commentAdminController@search'
    ]);
});
