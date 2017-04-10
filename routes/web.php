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

Route::get('/', 'PagesController@index');
Route::get('/index', 'PagesController@index');
Route::get('/rules', 'PagesController@rules');
Route::get('/faq', 'PagesController@faq');
Route::get('/aboutus', 'PagesController@aboutus');
Route::get('/howtoinvest', 'PagesController@howtoinvest');

Route::get('/support', 'SupportsController@create');
Route::post('/support', 'SupportsController@store');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/withdraw/pendings', 'PendingWithdrawsController@index');
    Route::post('/withdraw/process', 'PendingWithdrawsController@process');
    Route::get('/history/deposits', 'HistoryController@showDeposits');
    Route::get('/history/withdraws', 'HistoryController@showWithdraws');

    Route::get('/admin', 'AdminPagesController@index')->middleware('auth');
});

Auth::routes();
