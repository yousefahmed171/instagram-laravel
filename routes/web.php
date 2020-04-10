<?php

use Illuminate\Support\Facades\Route;

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
    if(Auth::check())
        return redirect('/home');
    else
        return view('auth/login');
});

Route::group(['middleware' => ['auth']], function() {
    //users
    Route::get('user/profile', 'UserController@edit');
    Route::patch('user/profile','UserController@update');
    Route::get('users', 'UserController@index');
    Route::get('userinfo/{id}', 'UserController@user_info');

    //search
    Route::get('search', 'UserController@autocomplete');

    //Post Route
    Route::resource('post', 'PostController');
    Route::get('user/posts','PostController@userPosts');
    Route::get('user/{id}/posts', 'PostController@userFriendPosts');

    //Like Route
    Route::resource('like', 'LikeController');

    //Comment Route
    Route::resource('comment', 'CommentController');

    //Follow Route
    Route::resource('follow', 'FollowController');
    Route::get('user/followers', 'FollowController@index');



    Route::get('/home', 'PostController@index')->name('home');

});

Auth::routes();


