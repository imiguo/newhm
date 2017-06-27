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

Route::match(['get', 'post'], '/payment/success', 'PaymentController@success');
Route::match(['get', 'post'], '/payment/failure', 'PaymentController@failure');
Route::match(['get', 'post'], '/payment/callback', 'PaymentController@callback');

Route::get('/deposit', 'PaymentController@deposit');
Route::post('/deposit_confirm', 'PaymentController@depositConfirm');

Route::get('/withdraw', 'PaymentController@withdraw');
Route::post('/withdraw_process', 'PaymentController@withdrawProcess');

Route::get('/account/summary', 'AccountController@summary');

Route::get('/history/deposits', function () {

});
Route::get('/history/earnings', function () {

});
Route::get('/history/referrals', function () {

});
Route::get('/history/withdrawals', function () {

});
Route::get('/referrals', 'AccountController@referrals');
Route::get('/account/link', 'AccountController@link');
Route::get('/account/edit', 'AccountController@edit');
Route::patch('/account/update', 'AccountController@update');

Route::get('/support', 'SupportsController@create');
Route::post('/support', 'SupportsController@store');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/old/withdraw/pendings', 'Admin\Old\PaymentsController@withdrawList');
    Route::post('/old/withdraw/process', 'Admin\Old\PaymentsController@withdrawProcess');
    Route::get('/old/history/deposits', 'Admin\Old\HistoryController@deposits');
    Route::get('/old/history/withdraws', 'Admin\Old\HistoryController@withdraws');

    Route::resource('/packages', 'Admin\PackagesController');
    Route::resource('/packages/{package}/plan', 'Admin\PlansController', ['only' => [
        'create', 'store', 'edit', 'update', 'destroy',
    ]]);

    Route::get('/admin', 'Admin\PagesController@index');
    Route::get('/admin/test', 'Admin\TestController@index');
});

Auth::routes();
