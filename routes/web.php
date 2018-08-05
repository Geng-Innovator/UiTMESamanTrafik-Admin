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

// admin route
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// admin routes
Route::get('/', 'AdminController@index');
Route::group(['prefix' => 'admin'], function() {
	Auth::routes();
	Route::post('ubah-katalaluan', 'AdminController@ubahKatalaluan')->name('admin.ubah_katalaluan');
	Route::post('laporan/jadual', 'AdminController@jadualkanLaporan')->name('admin.laporan.jadual');
	Route::post('laporan/tutup', 'AdminController@tutupKes')->name('admin.laporan.tutup');

	Route::get('dashboard', 'AdminController@showDashboard')->name('admin.dashboard');
	Route::get('form/ubah-katalaluan', 'AdminController@showUbahKatalaluan')->name('admin.form.ubah_katalaluan');
	Route::get('laporan/{id}', 'LaporanController@show')->name('admin.laporan');
	Route::get('profil', 'PekerjaController@showAdmin')->name('admin.profil');
	Route::get('info/staf/{id}', 'PekerjaController@showStaf')->name('admin.info.staf');
	Route::get('info/polis/{id}', 'PekerjaController@showPolis')->name('admin.info.polis');
	Route::get('info/pelajar/{id}', 'AdminController@showPelajar')->name('admin.info.pelajar');
});

// staf routes
Route::group(['prefix' => 'staf'], function() {
	Route::post('log-masuk', 'StafController@login');
	Route::post('reset-password', 'StafController@resetPassword');
	Route::post('dashboard', 'StafController@showDashboard');
	Route::post('profil', 'StafController@showProfil');
	Route::post('laporan/hantar-laporan', 'StafController@hantarLaporan');
	Route::post('laporan/info', 'StafController@showLaporan');

	Route::get('form/laporan/hantar-laporan', 'StafController@showHantarLaporan');
});

// polis routes
Route::group(['prefix' => 'polis'], function() {
	Route::post('log-masuk', 'PolisController@login');
	Route::post('reset-password', 'PolisController@resetPassword');
	Route::post('dashboard', 'PolisController@showDashboard');
	Route::post('profil', 'PolisController@showProfil');
	Route::post('laporan/info', 'PolisController@showLaporan');
	Route::post('laporan/hantar-laporan', 'PolisController@hantarLaporan');
	Route::post('laporan/maklum-balas', 'PolisController@maklumBalas');

	Route::get('form/laporan/maklum-balas', 'PolisController@showMaklumBalas');
	Route::get('form/laporan/hantar-laporan', 'PolisController@showHantarLaporan');
});

