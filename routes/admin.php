<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/12
 * Time: 13:51
 */
Route::get('/', 'LoginController@index')->name('admin.login.index');
Route::post('/login', 'LoginController@login')->name('admin.login');
Route::get('/loginout', 'LoginController@loginOut')->name('admin.loginout');
Route::get('/permissioninfo', 'HomeController@permissionInfo')->middleware('menu')->name('admin.permissionInfo');

Route::group(['middleware'=>['admin.login','permission','menu']],function(){
    Route::get('/home', 'HomeController@home')->name('admin.home');
    Route::resource('adminer','AdminController');
    Route::post('adminer/update/status','AdminController@updateStatus')->name('adminer.update.status');
    Route::resource('role','RoleController');
    Route::post('role/update/status','RoleController@updateStatus')->name('role.update.status');
    Route::resource('permission','PermissionController');
    Route::post('permission/update/status','PermissionController@updateStatus')->name('permission.update.status');
});
