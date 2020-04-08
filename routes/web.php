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

Route::get('/', function() {
    return redirect(route('login'));
});




Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/pasien', 'PatientController');
    Route::resource('/terapis', 'TerapistController')->except(['show']);
    Route::resource('/produk', 'ProductController')->except(['show']);
    Route::resource('/terapi', 'TeraphyController')->except(['show']);

    Route::get('/mecart', 'CartController@meindex')->name('cart.index');
    Route::post('/mecart/add/{id}', 'CartController@addItem')->name('cart.addItem');
    Route::post('/mecart/remove/{id}', 'CartController@removeItem')->name('cart.removeItem');
    Route::post('/mecart/update/{id}', 'CartController@updateItem')->name('cart.updateItem');
    Route::get('/mecart/destroy', 'CartController@destroy')->name('cart.destroy');

    Route::get('/pembelian', 'OrderController@index')->name('order.index');
    Route::post('/pembelian/buat', 'OrderController@store')->name('order.store');

    Route::resource('/rawat-jalan', 'RawatJalanController')->except(['edit','update']);
    Route::post('/rawat-jalan/add', 'RawatJalanController@addItem')->name('rawat-jalan.addItem');
    Route::get('/rawat-jalan/remove/{id}', 'RawatJalanController@removeItem')->name('rawat-jalan.removeItem');

    Route::resource('/obat-herbal', 'ObatHerbalController')->except(['edit','update']);
    Route::post('/obat-herbal/add', 'ObatHerbalController@addItem')->name('obat-herbal.addItem');
    Route::get('/obat-herbal/remove/{id}', 'ObatHerbalController@removeItem')->name('obat-herbal.removeItem');

    Route::resource('/rawat-inap', 'RawatInapController')->except(['edit','update']);
    Route::post('/rawat-inap/add', 'RawatInapController@addItem')->name('rawat-inap.addItem');
    Route::get('/rawat-inap/remove/{id}', 'RawatInapController@removeItem')->name('rawat-inap.removeItem');

    Route::resource('/rawat-kunjungan', 'RawatKunjunganController')->except(['edit','update']);
    Route::post('/rawat-kunjungan/add', 'RawatKunjunganController@addItem')->name('rawat-kunjungan.addItem');
    Route::get('/rawat-kunjungan/remove/{id}', 'RawatKunjunganController@removeItem')->name('rawat-kunjungan.removeItem');

    //Transaksi dari pasien
    Route::get('/pasienrawarjalan/{id}', 'PatientController@patientRawatJalan')->name('patient.rawatJalan');
    Route::get('/pasienrawarinap/{id}', 'PatientController@patientRawatInap')->name('patient.rawatInap');
    Route::get('/pasienrawarkunjungan/{id}', 'PatientController@patientRawatKunjungan')->name('patient.rawatKunjungan');
    Route::get('/pasienobatherbal/{id}', 'PatientController@patientObatHerbal')->name('patient.obatHerbal');

});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);