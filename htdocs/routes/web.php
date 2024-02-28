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

Route::get('/admin', [AdministratorController::class, 'showLogin']);
Route::get('/admin/dashboard', [AdministratorController::class, 'showAdministratorPanel']);

Route::get('/admin/races', [RaceController::class, 'showAdministratorPanel'])->name('/admin/races');
Route::get('/admin/insurances', [InsuranceController::class, 'showAdministratorPanel']);
Route::get('/admin/sponsors', [SponsorController::class, 'showAdministratorPanel']);
Route::get('/admin/drivers', [DriverController::class, 'showAdministratorPanel']);

Route::get('/admin/races/new', [RaceController::class, 'new']);
Route::post('/admin/races/new', [RaceController::class, 'create'])->name('/admin/races/new');

Route::get('/admin/drivers', [DriverController::class, 'index'])->name('/admin/drivers');
Route::get('/admin/drivers/new', [DriverController::class, 'new']);
Route::post('/admin/drivers/new', [DriverController::class, 'create'])->name('/admin/drivers/new');