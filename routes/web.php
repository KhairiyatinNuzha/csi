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
Route::get('kelas','ClassController@index')->name('kelas.index');
Route::get('kelas/tambah','ClassController@tambah')->name('kelas.tambah');
Route::post('kelas/simpan','ClassController@simpan')->name('kelas.simpan');
Route::get('kelas/edit/{id}','ClassController@edit')->name('kelas.edit');
Route::post('kelas/update/{id}','ClassController@update')->name('kelas.update');
Route::get('kelas/delete/{id}','ClassController@delete')->name('kelas.delete');
Route::get('kelas/detail/{id}','ClassController@detail')->name('kelas.detail');
Route::get('kelasdosen','ClassLecturerController@index')->name('kelaslecturer.index');
Route::get('kelasdosen/tambahdosenkelas','ClassLecturerController@tambah')->name('kelaslecturer.tambah');
Route::post('kelasdosen/simpandosenkelas','ClassLecturerController@simpan')->name('kelas.simpandosenkelas');
Route::get('kelasdosen/detail/{id}','ClassLecturer@detail')->name('kelaslecturer.detail');

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('home', 'HomeController@index')->name('home');

    require(__DIR__ . '/backend/master.php');
});
