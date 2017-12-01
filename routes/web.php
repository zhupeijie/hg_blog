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

Route::group(['namespace' => 'Home'], function () {

    Route::get('/', 'TopicsController@index')->name('index');

    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

    Route::resource('topics', 'TopicsController');

    Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

//    Route::get('password', 'PasswordController@password')->name('user.password');
//    Route::post('password/update', 'PasswordController@update')->name('user.password.update');

//    Route::get('avatar', 'UsersController@avatar')->name('user.avatar');
//    /** 上传用户头像 */
//    Route::group(['prefix' => 'uploads'], function () {
//        Route::post('user-avatar', 'UploadController@userAvatar')->name('uploads.user.avatar');
//    });
});
