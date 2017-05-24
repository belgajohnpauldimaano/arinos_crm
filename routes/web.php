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

Route::get('/', function () {

    return view('main');

})->name('main');

Route::get('/file_capture', 'FilecaptureController@index')->name('file_capture');
Route::post('/call_list', 'FilecaptureController@call_list')->name('call_list');
Route::post('/dm_acquisition_list', 'FilecaptureController@dm_acquisition_list');
Route::get('/dm_acquisition_list_duplicate', 'FilecaptureController@dm_acquisition_list_duplicate')->name('dm_acquisition_list_duplicate');

Route::post('/ng_list', 'FilecaptureController@ng_list')->name('ng_list');

Route::post('/dm_completion_list', 'FilecaptureController@dm_completion_list')->name('dm_completion_list');
Route::get('/dm_completion_list_duplicate', 'FilecaptureController@dm_completion_list_duplicate')->name('dm_completion_list_duplicate');
Route::get('/dm_sending_unregistered_list/{filename?}', 'FilecaptureController@dm_sending_unregistered_list')->name('dm_sending_unregistered_list');

//TempRoute
Route::get('/file_update/{id}', 'CustomerUpdateController@file_update')->name('file_update');
Route::post('/customer_update/{id}', 'CustomerUpdateController@customer_update')->name('customer_update');

Route::get('/customer_search', 'CustomerSearchController@index')->name('customer_search');
Route::post('/search_customer', 'CustomerSearchController@search_customer')->name('search_customer');
Route::get('/search_minor_industry', 'CustomerSearchController@search_minor_industry')->name('search_minor_industry');
Route::get('/generate_csv', 'CustomerSearchController@generateCSV')->name('generateCSV');