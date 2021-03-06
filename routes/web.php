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

    Route::get('/', 'TopicsController@index')->name('root');

    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

    Route::resource('p', 'TopicsController');

    Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

    Route::resource('labels', 'LabelsController', ['only' => ['show']]);

//    Route::get('password', 'PasswordController@password')->name('user.password');
//    Route::post('password/update', 'PasswordController@update')->name('user.password.update');

//    Route::get('avatar', 'UsersController@avatar')->name('user.avatar');
//    /** 上传用户头像 */
//    Route::group(['prefix' => 'uploads'], function () {
//        Route::post('user-avatar', 'UploadController@userAvatar')->name('uploads.user.avatar');
//    });
});

/** 社会化登录(Socialite) */
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/oauth/github', 'SocialiteController@github')->name('oauth.github');
    Route::get('/oauth/github/callback', 'SocialiteController@githubCallBack')->name('oauth.github.callback');
});

/** spa */
Route::group(['namespace' => 'Manage'], function () {
    Route::any('manage', function () {
        return view('manage.layouts.app');
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
    Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');
    Route::resource('topics', 'TopicsController', ['as'=>'admin']);
    Route::get('/timeline', function () {
        return view('admin.timeline.index');
    });
});