<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();


Route::group(['middleware' => ['web', 'auth'], 'as' => 'admin.'], function() {
    Route::resource('app_status', 'Admin\AppStatusController');
    Route::resource('store', 'Admin\StoreController');
    Route::resource('delivery_partner', 'Admin\DeliveryPartnerController');
});