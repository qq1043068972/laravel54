<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/2
 * Time: 20:44
 */

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::get('login','LoginController@index');
    Route::post('login','LoginController@login');


    Route::group(['middleware'=>'adminchecklogin'],function(){

        Route::get('/logout','LoginController@logout');

        //home页面
        Route::get('/home','HomeController@index');

        //管理人员页面
        Route::resource('/users','UserController');
        Route::get('/users/{user}/destroy','UserController@destroy');//删除
        Route::get('/users/{user}/status','UserController@isStatus');//是否停用





    });

});