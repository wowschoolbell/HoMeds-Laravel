<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/migrate', function() {
   Artisan::call('migrate');
   return "migrate!";
});

// Migration rollback 
Route::get('/migrate-rollbak', function() {
   Artisan::call('migrate:rollback');
   return "Migration roll back!";
});

// Application Cache clear
Route::get('/cache-clear', function() {
   Artisan::call('optimize:clear');
   return "Cache cleared!";
});

// Storage Link
Route::get('/storage-link', function() {
   Artisan::call('storage:link');
   return "Storage liniked Successfully!";
});

Route::get('/makemodel', function() {
   Artisan::call('make:model store -mc');
   return "migrate!";
});