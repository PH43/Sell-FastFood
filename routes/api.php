<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//admin
Route::get('admin/product/auto_complete_search', 'Api\ProductController@auto_complete_search');

Route::get('admin/user/auto_complete_search_user', 'Api\ApiUserController@auto_complete_search_user');

Route::get('admin/order/auto_complete_search_order', 'Api\ApiOrderController@auto_complete_search_order');

Route::get('admin/category/auto_complete_search_category', 'Api\ApiCategoryController@auto_complete_search_category');

Route::get('admin/comment/auto_complete_search_comment', 'Api\ApiCommentController@auto_complete_search_comment');
//home
Route::get('home/product/auto_complete_search_product_home', 'Api\ApiSearchProductHomeController@auto_complete_search_product_home');
