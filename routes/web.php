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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/content/{content}', 'HomeController@showPost')->name('comment.view');
Route::get('/comment/{content}', 'HomeController@showComment')->name('reply.view');

Route::resource('/comment','CommentController');
Route::resource('/reply','ReplyController');
Route::resource('/like','LikeController');
Route::resource('/dislike','DislikeController');

Route::post('/search','QueryController@search')->name('query');


Route::group(['prefix' => 'admin','middleware'=>'can:access_admin'],function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin');

	Route::resource('/tag','Admin\TagController');
	Route::resource('/user','Admin\UserController');
	Route::resource('/role','Admin\RoleController');
	Route::resource('/permission','Admin\PermissionController');
	Route::resource('/category','Admin\CategoryController');

	Route::resource('/article','ArticleController');
    Route::resource('/post','VideoController');

	
});