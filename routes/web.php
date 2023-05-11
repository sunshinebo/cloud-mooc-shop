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

//必包路由
Route::get('/home', function () {
    return view('welcome');
});

//支持不同的method
Route::get('home/hello', 'HomeController@hello')->middleware('benchmark');
Route::get('home/hello2', 'HomeController@hello2');
Route::get('home/dbTest', 'HomeController@dbTest');
//Route::match(['get', 'post'], 'home/hello', 'HomeController@hello');
//Route::any('home/hello', 'HomeController@hello');//不推荐在生产环境使用

//重定向
Route::get('here', function () {
    return '重定向前';
});
Route::get('there', function () {
    return '重定向后';
});
//301 - 永久重定向
Route::permanentRedirect('here', 'there');
//302 - 临时重定向
Route::redirect('here', 'there');

//Route::any('getOrder','HomeContorller@getOrder');
//Route::get('getOrder/{id}/{name}','HomeContorller@getOrder');
Route::get('getOrder/{id}/{name}', function ($id, $name) {
    return [1, $id, $name];
})->where('name', '*');

Route::get('getUser', 'HomeController@getUser')->name('get.user');
Route::get('getUrl', function () {
//    return redirect()->route('get.user',['id'=>10]);
//    return redirect()->to(\route('get.user',['id'=>10]));
    return route('get.user', [], false);
});
