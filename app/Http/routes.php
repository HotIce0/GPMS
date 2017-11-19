<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//直接跳转到主页
Route::get('/', function () {
    return redirect('/home');
});
// 用户登陆认证路由
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

//主页
Route::get('/home', 'HomeController@index');

//需用户认证的路由
Route::Group(['middleware'=>'auth'],function() {

});