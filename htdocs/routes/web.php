<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\DriverController;

Route::get('/', function () {
    return view('welcome');
});

// ADMINISTRATOR
Route::group(['prefix' => '/admin'], function () {
    Route::get('', [AdministratorController::class, 'showLogin']);
    Route::post('', [AdministratorController::class, 'auth'])->name('admin.login');
    Route::get('/logout', [AdministratorController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdministratorController::class, 'showAdministratorPanel'])->name('admin.dashboard');

        // ADMINISTRATOR: RACES
        Route::prefix('/races')->group(function () {
            Route::get('', [RaceController::class, 'index'])->name('admin.races');
            Route::get('/new', [RaceController::class, 'new']);
            Route::post('/new', [RaceController::class, 'verify_details'])->name('admin.races.new');
            Route::middleware(['race.creating'])->group(function () {
                Route::get('/new/insurances', [RaceController::class, 'new_insurances'])->name('admin.races.new.insurances');
                Route::post('/new/insurances', [RaceController::class, 'verify_insurances'])->name('admin.races.new.insurances');
                Route::get('/new/sponsors', [RaceController::class, 'new_sponsors'])->name('admin.races.new.sponsors');
                Route::post('/new/sponsors', [RaceController::class, 'verify_sponsors'])->name('admin.races.new.sponsors');
            });
            Route::get('/show/{id}', [RaceController::class, 'show'])->name('admin.races.show');
            Route::get('/edit/{id}', [RaceController::class, 'edit'])->name('admin.races.edit');
            Route::post('/edit/{id}', [RaceController::class, 'update'])->name('admin.races.update');
        });

        // ADMINISTRATOR: DRIVERS
        Route::prefix('/drivers')->group(function () {
            Route::get('', [DriverController::class, 'index'])->name('admin.drivers');
            Route::get('/new', [DriverController::class, 'new']);
            Route::post('/new', [DriverController::class, 'create'])->name('admin.drivers.new');
            Route::get('/edit/{id}', [DriverController::class, 'edit'])->name('admin.drivers.edit');
            Route::post('/edit/{id}', [DriverController::class, 'update'])->name('admin.drivers.update');
        });

        // ADMINISTRATOR: INSURANCES
        Route::prefix('/insurances')->group(function () {
            Route::get('', [InsuranceController::class, 'index'])->name('admin.insurances');
            Route::get('/new', [InsuranceController::class, 'new']);
            Route::post('/new', [InsuranceController::class, 'create'])->name('admin.insurances.new');
            Route::get('/edit/{id}', [InsuranceController::class, 'edit'])->name('admin.insurances.edit');
            Route::post('/edit/{id}', [InsuranceController::class, 'update'])->name('admin.insurances.update');
        });

        // ADMINISTRATOR: SPONSORS
        Route::prefix('/sponsors')->group(function () {
            Route::get('', [SponsorController::class, 'index'])->name('admin.sponsors');
            Route::get('/new', [SponsorController::class, 'new']);
            Route::post('/new', [SponsorController::class, 'create'])->name('admin.sponsors.new');
            Route::get('/edit/{id}', [SponsorController::class, 'edit'])->name('admin.sponsors.edit');
            Route::post('/edit/{id}', [SponsorController::class, 'update'])->name('admin.sponsors.update');
        });
    });
});
