<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
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

    //Project Routes
    Route::get('/', [ProjectController::class, 'index'])->name('homepage');
    Route::get('new-project', [ProjectController::class, 'createProjectForm'])->name('project.create.form');
    Route::get('update-status/{project_id}', [ProjectController::class, 'changeProjectCompletion'])->name('project.status');
    Route::post('new-project', [ProjectController::class, 'createProject'])->name('project.create');
    Route::delete('project/{project_id}', [ProjectController::class, 'deleteProject'])->name("project.delete");
    Route::get('project-info/{project_id}', [ProjectController::class, 'update'])->name('project.update.form');
    Route::post('project-update', [ProjectController::class, 'updateProject'])->name('project.update');

    //Apartment and floor Routes
    Route::get('project-details/{project_id}', [ApartmentController::class, 'index'])->name('project-details');
    Route::get('new-apartment', [ApartmentController::class, 'createApartmentForm'])->name('apartment.create.form');
    Route::post('new-apartment', [ApartmentController::class, 'createApartment'])->name('apartment.create');
    Route::get('new-floor', [ApartmentController::class, 'createFloorForm'])->name('floor.create.form');
    Route::post('new-floor', [ApartmentController::class, 'createApartment'])->name('apartment.create');



    //Company info update
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

