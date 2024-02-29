<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\DriverController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ADMINISTRATOR
Route::get('/admin', [AdministratorController::class, 'showLogin']);
Route::post('/admin', [AdministratorController::class, 'auth'])->name('/admin');
Route::get('/admin/logout', [AdministratorController::class, 'logout'])->name('admin/logout');
Route::get('/admin/dashboard', [AdministratorController::class, 'showAdministratorPanel'])->name('/admin/dashboard');

// ADMINISTRATOR: RACES
Route::get('/admin/races', [RaceController::class, 'index'])->name('/admin/races');
Route::get('/admin/races/new', [RaceController::class, 'new']);
Route::post('/admin/races/new', [RaceController::class, 'create'])->name('/admin/races/new');
Route::get('/admin/races/edit/{id}', [RaceController::class, 'edit'])->name('admin.races.edit');
Route::post('/admin/races/edit/{id}', [RaceController::class, 'update'])->name('admin.races.update');

// ADMINISTRATOR: DRIVERS
Route::get('/admin/drivers', [DriverController::class, 'index'])->name('/admin/drivers');
Route::get('/admin/drivers/new', [DriverController::class, 'new']);
Route::post('/admin/drivers/new', [DriverController::class, 'create'])->name('/admin/drivers/new');
Route::get('/admin/drivers/edit/{id}', [DriverController::class, 'edit'])->name('admin.drivers.edit');
Route::post('/admin/drivers/edit/{id}', [DriverController::class, 'update'])->name('admin.drivers.update');

// ADMINISTRATOR: INSURANCES
Route::get('/admin/insurances', [InsuranceController::class, 'index'])->name('/admin/insurances');
Route::get('/admin/insurances/new', [InsuranceController::class, 'new']);
Route::post('/admin/insurances/new', [InsuranceController::class, 'create'])->name('/admin/insurances/new');
Route::get('/admin/insurances/edit/{id}', [InsuranceController::class, 'edit'])->name('admin.insurances.edit');
Route::post('/admin/insurances/edit/{id}', [InsuranceController::class, 'update'])->name('admin.insurances.update');


// ADMINISTRATOR: SPONSORS
Route::get('/admin/sponsors', [SponsorController::class, 'index'])->name('/admin/sponsors');
Route::get('/admin/sponsors/new', [SponsorController::class, 'new']);
Route::post('/admin/sponsors/new', [SponsorController::class, 'create'])->name('/admin/sponsors/new');