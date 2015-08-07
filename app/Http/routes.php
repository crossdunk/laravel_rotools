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

Route::get('/', 'IndexController@index');

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
  Route::get('login', 'AuthController@getLogin');
  Route::post('login', 'AuthController@postLogin');
  Route::get('register', 'AuthController@getRegister');
  Route::post('register', 'AuthController@postRegister');
  Route::get('logout', 'AuthController@getLogout');
});


Route::group(['prefix'=>'article','namespace'=>'Article'],function(){
  Route::get('/', 'ArticleController@index');
  Route::get('create', [
    'middleware' => 'auth',
    'uses' => 'ArticleController@create'
  ]);
  Route::post('create', 'ArticleController@store');
  Route::get('/{id}', 'ArticleController@show');
  Route::delete('/{id}', 'ArticleController@destroy');
  Route::get('/{id}/edit', 'ArticleController@edit');
  Route::patch('/{id}', 'ArticleController@update');
  Route::post('{id}/comment', 'ArticleController@comment');
});


Route::get('test','TestController@index');

