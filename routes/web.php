<?php


use App\Http\Controllers\DistributionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaccineStatusController;
use Illuminate\Support\Facades\Route;


Route::get('/',function (){
    return view('welcome');
});

Route::prefix('vaccine')->group(function () {
    Route::get('/registration', [RegistrationController::class, 'create'])->name('registration.create');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
    Route::get('/schedule', 'DistributionController')->name('vaccine.schedule');
    Route::get('/search', [VaccineStatusController::class, 'showStatusForm'])->name('status.form');
    Route::post('/search', [VaccineStatusController::class, 'checkStatus'])->name('status.check');
});

