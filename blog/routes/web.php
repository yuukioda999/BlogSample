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

//ブログ一覧表示
Route::get('/','BlogController@showList')->name('blogs');

//ブログ登録画面表示
Route::get('/blog/create','BlogController@showCreate')->name('create');

//ブログ登録
Route::post('/blog/store','BlogController@exeStore')->name('store');

//ブログ詳細表示
Route::get('/blog/{id}','BlogController@showDetail')->name('show');

//ブログ編集画面を表示
Route::get('/blog/edit/{id}','BlogController@showEdit')->name('edit');

//ブログ編集
Route::post('/blog/update','BlogController@exeUpdate')->name('update');

//ブログ削除
Route::post('/blog/delete/{id}','BlogController@exeDelete')->name('delete');



