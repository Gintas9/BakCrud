<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
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




Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::resource('gamas','App\Http\Controllers\GamaController');



Route::resource('zettas','App\Http\Controllers\ZettaController');
Route::resource('booleans','App\Http\Controllers\BooleanController');
Route::resource('omegas','App\Http\Controllers\OmegaController');
Route::resource('downloads','App\Http\Controllers\DownloadController');
Route::resource('sigmas','App\Http\Controllers\SigmaController');
Route::resource('deltas','App\Http\Controllers\DeltaController');
Route::resource('omicrons','App\Http\Controllers\OmicronController');
Route::resource('moderators','App\Http\Controllers\ModeratorController');
Route::resource('admins','App\Http\Controllers\AdminController');
Route::resource('lambdas','App\Http\Controllers\LambdaController');