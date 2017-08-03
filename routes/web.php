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

Route::get('login','Face\LoginController@index');
Route::post('login','Face\LoginController@login');


Route::get('register','Face\RegisterController@create');
Route::post('register','Face\RegisterController@store');

Route::group(['middleware' => ['checklogin']],function(){

    Route::get('logout','Face\LoginController@logout');

    //个人设置
    Route::get('user/me/setting','Face\UserController@setting');
    Route::post('user/me/setting','Face\UserController@settingStore');

    //个人中心
    Route::get('user/me/{user}','Face\UserController@userCentre');
    Route::any('user/{user}/fan','Face\UserController@userFan');
    Route::any('user/{user}/unfan','Face\UserController@userUnFan');

    //文章
    Route::resource('posts','Face\PostController');
    Route::get('posts/{post}/destroy','Face\PostController@destroy');

    //评论
    Route::post('posts/comment','Face\PostController@comment');

    //赞
    Route::get('posts/{post}/zan','Face\PostController@zan');
    Route::get('posts/{post}/unzan','Face\PostController@unzan');

    //专题
    Route::get('topics/{topic}','Face\TopicController@index');
    Route::post('topics/submit/{topic}','Face\TopicController@submit');

});

include_once("admin.php");
