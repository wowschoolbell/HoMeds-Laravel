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
    Route::resource('configurations', 'Admin\ConfigurationController');

    Route::match(array('GET','POST'),'states/import', 'Admin\StateController@import')->name('states.import');
    Route::resource('states', 'Admin\StateController');
    
    Route::match(array('GET','POST'),'cities/import', 'Admin\CityController@import')->name('cities.import');
    Route::resource('cities', 'Admin\CityController');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/passwordreset/{hashid}','HomeController@password_reset')->withoutMiddleware('auth');
Route::post('/passwordreset','HomeController@password_update')->withoutMiddleware('auth');
