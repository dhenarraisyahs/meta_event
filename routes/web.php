<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\EventController;

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


Route::group(['middleware' => 'auth'], function () {


	Route::get('/', 'HomeController@index')->name('home');

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('event/list', 'EventController@data')->name('event.list');
	Route::resource('event', 'EventController');

	Route::get('location/print_qr/{id}', 'LocationController@print_qr')->name('location.print_qr');
	Route::get('location/statistic', 'LocationController@statistic')->name('location.statistic');
	Route::get('location/list', 'LocationController@data')->name('location.list');
	Route::resource('location', 'LocationController');

	Route::get('participant/list', 'ParticipantController@data')->name('participant.list');
	Route::resource('participant', 'ParticipantController');

	Route::get('attendance/list', 'AttendanceController@data')->name('attendance.list');
	Route::get('check_in_form/{location_id}', 'AttendanceController@check_in_form')->name('attendance.check_in_form');
	Route::get('check_in_result/{attendance_id}', 'AttendanceController@check_in_result')->name('attendance.check_in_result');
	Route::resource('attendance', 'AttendanceController');

});

