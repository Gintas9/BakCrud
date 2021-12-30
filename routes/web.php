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




Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name("dashboard.index");
Route::get('main', [CustomAuthController::class, 'main'])->name("main.index");

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('admins/controller/{admin}', [\App\Http\Controllers\AdminController::class, 'resubmitController'])->name('controllerAdmin');
Route::get('admins/view/{admin}', [\App\Http\Controllers\AdminController::class, 'resubmitView'])->name('viewAdmin');
Route::get('admins/migrate/{admin}', [\App\Http\Controllers\AdminController::class, 'resubmitMigration'])->name('migrateAdmin');







Route::resource('booleans','App\Http\Controllers\BooleanController');

Route::resource('downloads','App\Http\Controllers\DownloadController');
Route::resource('sigmas','App\Http\Controllers\SigmaController');
Route::resource('deltas','App\Http\Controllers\DeltaController');
Route::resource('omicrons','App\Http\Controllers\OmicronController');
Route::resource('moderators','App\Http\Controllers\ModeratorController');
Route::resource('admins','App\Http\Controllers\AdminController');
Route::resource('bans','App\Http\Controllers\BanController');

