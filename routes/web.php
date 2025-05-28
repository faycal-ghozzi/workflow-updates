<?php

use App\Http\Controllers\CompensationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function(){

    Route::get('/', function() {
        return redirect()->route('dashboard');
    });

    Route::middleware('permission:compensation')->group(function(){
        Route::controller(CompensationController::class)->group(function () {
            Route::get('/compensation', 'list')->name('compensation.list');
            Route::get('/compensation/historique', 'historique')->name('compensation.historique');
            Route::get('/compensation/etat_journalier', 'etatJournalier')->name('compensation.etat_journalier');
            Route::get('/compensation/extrait', 'extrait')->name('compensation.extrait');
            Route::get('/compensation/get_client', 'getClient')->name('compensation.get_client');
            Route::get('/compensation/wsdata/{type}', 'fetchWsData');
        });
    });

    Route::middleware('permission:users')->group(function(){
        Route::controller(UserController::class)->group(function() {
            Route::get('/users', 'list')->name('users.list');
        });
    });
    // Route::get('/compensation', [CompensationController::class, 'list'])->name('compensation.list');
    // Route::get('/compensation/historique', [CompensationController::class, 'historique'])->name('compensation.historique');
    // Route::get('/compensation/etat_journalier', [CompensationController::class, 'etatJournalier'])->name('compensation.etat_journalier');
    // Route::get('/compensation/extrait', [CompensationController::class, 'extrait'])->name('compensation.extrait');
    // Route::get('/compensation/get_client', [CompensationController::class, 'getClient'])->name('compensation.get_client');
    // Route::get('/compensation/wsdata/{type}', [CompensationController::class, 'fetchWsData']);


    // Route::post('/compensation/get_client/check/{accountNumber}', [CompensationController::class, 'checkClient'])->name('compensation.check_client');
    // Route::post('/compensation/get_client/add_request', [CompensationController::class, 'addRequest'])->name('compensation.add_request');
    // Route::post('/compensation/store/ws', [CompensationController::class, 'store_compensation'])->name('compensation.store_compensation');

    // Route::get('/compensation/display/{id}', [CompensationController::class, 'display'])->name('compensation.display');

    // Route::get('/compensation/edit/{id}', function ($id) {
    //     return "Testing edit route OK! ID: {$id}";
    // })->name('compensationedit');
    
});


require __DIR__.'/auth.php';
