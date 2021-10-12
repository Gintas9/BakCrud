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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('temps','App\Http\Controllers\TempController');
Route::resource('tests','App\Http\Controllers\TestController');
Route::resource('alphas','App\Http\Controllers\AlphaController');
Route::resource('betas','App\Http\Controllers\BetaController');
Route::resource('gamas','App\Http\Controllers\GamaController');