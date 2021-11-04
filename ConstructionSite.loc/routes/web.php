<?php

use App\Http\Controllers\AuthController;
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


Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard.homepage')->name('dashboard');
    Route::get('company-info', [AuthController::class, 'update'])->name('update.company');
    Route::post('custom-update', [AuthController::class, 'customUpdate'])->name('update.custom');
    Route::get('password-change', [AuthController::class, 'passwordChange'])->name('change.password');
    Route::post('password-update', [AuthController::class, 'passwordUpdate'])->name('update.password');
});




//Login Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

//Registration
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');

