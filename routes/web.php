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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

/** Routing Pengelolaan Semhas */
Route::get('/thesis_seminar', 'ThesisSeminarController@index')->name('admin.semhas.index');  //routing lihat daftar semhas
Route::post('/thesis_seminar', 'ThesisSeminarController@store')->name('admin.semhas.store'); //routing simpan data semhas
Route::get('/thesis_seminar/create', 'ThesisSeminarController@create'); //routing tampilkan form data semhas 
Route::delete('/thesis_seminar/{id}', 'ThesisSeminarController@destroy')->name('admin.semhas.destroy'); //routing hapus data semhas 
Route::patch('/thesis_seminar/{semhas}', 'ThesisSeminarController@update'); //routing simpan perubahan data semhas
Route::get('/thesis_seminar/{id}', 'ThesisSeminarController@show')->name('admin.semhas.show'); //routing tampilkan detail semhas
Route::get('/thesis_seminar/{semhas}/edit', 'ThesisSeminarController@edit')->name('admin.semhas.edit');  //routing tampilkan form edit semhas

/** Routing Pengelolaan Peserta Semhas */
Route::get('/admin/pesertasemhas/{id}/add', 'ThesisSemAudienceController@create')->name('admin.pesertasemhas.create'); //routing tampilkan form data semhas 
Route::get('/thesissem_audience/{id}', 'ThesisSemAudienceController@index')->name('admin.pesertasemhas.index');  //routing lihat daftar peserta semhas
Route::post('/admin/pesertasemhas', 'ThesisSemAudienceController@store')->name('admin.pesertasemhas.store'); //routing simpan data peserta semhas
Route::delete('/admin/pesertasemhas/{id}', 'ThesisSemAudienceController@destroy')->name('admin.pesertasemhas.destroy'); //routing hapus data peserta semhas 
Route::get('/admin/pesertasemhas/{id}', 'ThesisSemAudienceController@show')->name('admin.pesertasemhas.show'); //routing tampilkan detail semhas

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('home', 'HomeController@index')->name('home');

    require(__DIR__ . '/backend/master.php');

});

