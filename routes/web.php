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

use App\History;

Route::get('/', function() {
    return redirect('/withdraw/pendings');
});

Route::get('/withdraw/pendings', 'PendingWithdrawsController@index');

Route::post('/withdraw/process', 'PendingWithdrawsController@process');

Route::get('/test', function () {

});
