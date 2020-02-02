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

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::post('/postlogin', 'AuthController@postlogin')->name('postlogin');

 Route::middleware('auth')->group( function() {
    Route::get('/home', 'DashboardController@index')->name('home');

    //Supervisor
    Route::get('/supervisor', 'ThesisSupervisorController@index')->name('admin.supervisor.index');
    Route::get('/supervisor/accepted/{id}', 'ThesisSupervisorController@accepted')->name('admin.supervisor.accepted');
    Route::get('/supervisor/rejected/{id}', 'ThesisSupervisorController@rejected')->name('admin.supervisor.rejected');

    //Tugas Akhir
    Route::get('/mahasiswa', 'ThesisController@index')->name('students.index');
    Route::get('/mahasiswa/logbook/{id}', 'ThesisLogbookController@index')->name('student.ta_logbook.index');
    Route::post('/mahasiswa/store/', 'ThesisController@store')->name('student.theses.store');
    Route::get('/mahasiswa/detail/{id}', 'ThesisController@show')->name('student.theses.show');
    Route::post('/mahasiswa/supervisor/', 'ThesisSupervisorController@create')->name('student.supervisor.create');
 });


// Route::group(['namespace' => 'backend', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    
//     Route::get('home', 'HomeController@index')->name('home');
//     require(__DIR__ . '/backend/master.php');
// });

// Route::get('/admin/mahasiswa', 'StudentSemesterController@index')->name('admin.mahasiswa.index');
