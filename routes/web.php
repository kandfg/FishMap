<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::get('/home', [App\Http\Controllers\LoginWebController::class, 'index'])->name('home');
Route::get('/get-map',[App\Http\Controllers\MapController::class, 'getMap']);
Route::get('/contact-us',[App\Http\Controllers\WebController::class,'contact_us'])->name('contact-us');
Route::get('/get-fish',[App\Http\Controllers\WebController::class,'getFish']);
Route::get('/get-coordinate',[App\Http\Controllers\MapController::class,'getCoordinate']);


Route::get('/coordinate',[App\Http\Controllers\Admin\CoordinateController::class,'index'])->name('coordinate');
Route::post('/coordinate/create',[App\Http\Controllers\Admin\CoordinateController::class,'create'])->name('create_coordinate');
Route::delete('/coordinate/{id}',[App\Http\Controllers\Admin\CoordinateController::class,'destroy'])->name('destory_coordinate');
Route::get('/coordinate/{id}',[App\Http\Controllers\Admin\CoordinateController::class,'show'])->name('show_coordinate');