<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PaypalController;

Route::get('/', [RaceController::class, 'mainPage'])->name('main.page');
Route::get('/races', [RaceController::class, 'allRaces'])->name('races.all');
Route::get('/races/{race}', [RaceController::class, 'show'])->name('race.detail');
Route::get('/gallery', [ImageController::class, 'gallery'])->name('page.gallery');
Route::post('/race/register', [RaceController::class, 'registerDriver'])->name('race.register');
Route::get('/profile/{driver}', [DriverController::class, 'profile'])->name('page.profile');
Route::get('/membership', [DriverController::class, 'membership'])->name('page.membership');
Route::get('/setTimeToDriver/{raceId}/{driverId}', [RaceController::class, 'setTimeToDriver'])->name('setTimeToDriver');
Route::get('raceClassification/{raceId}', [RaceController::class, 'getClassification'])->name('classificationTest');

Route::get('/register', [DriverController::class, 'showRegister'])->name('user.showRegister');
Route::post('/register', [DriverController::class, 'register'])->name('user.register');
Route::get('/login', [DriverController::class, 'showLogin'])->name('user.showLogin');
Route::post('/login', [DriverController::class, 'auth'])->name('user.login');
Route::get('/logout', [DriverController::class, 'logout'])->name('user.logout');

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
            Route::get('/race-pdf/{raceId}', [PDFController::class, 'generateRacePDF'])->name('generate.race.pdf');
            Route::get('/assignRaceNumbers/{raceId}', [RaceController::class, 'assignRaceNumbers'])->name('admin.races.asignRaceNumbers');
            Route::get('/generateDorsalPDF/{raceId}/{driverId}', [PDFController::class, 'generateDorsalPDF'])->name('generateQR');
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
            Route::get('/generate-pdf/{sponsorId}', [PDFController::class, 'generateSponsorPDF'])->name('generate-pdf');
        });
    });
});

Route::middleware(['ajax'])->group(function () {
    Route::post('/races/search', [RaceController::class, 'search'])->name('admin.races.search');
    Route::post('/drivers/search', [DriverController::class, 'search'])->name('admin.races.search');
    Route::post('/insurances/search', [InsuranceController::class, 'search'])->name('admin.races.search');
    Route::post('/sponsors/search', [SponsorController::class, 'search'])->name('admin.races.search');
});
Route::post('/generateDorsals', [RaceController::class, 'generateDorsals'])->name('admin.races.generateDorsals');
Route::post('/races/find', [RaceController::class, 'find'])->name('admin.races.find');
Route::get('/races/find/{id}', [RaceController::class, 'find'])->name('admin.races.find');



//Route::get('/paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::get('/paywithpaypal', [PaypalController::class, 'payWithPaypal'])->name('paywithpaypal');
Route::post('/paypal', array('as' => 'paypal','uses' => 'App\Http\Controllers\PaypalController@postPaymentWithpaypal'));
Route::get('/paypal', array('as' => 'status','uses' => 'App\Http\Controllers\PaypalController@getPaymentStatus'));