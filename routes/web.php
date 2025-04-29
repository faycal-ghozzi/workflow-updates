<?php

use App\Http\Controllers\CompensationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/compensation', [CompensationController::class, 'list'])->name('compensation.list');
    Route::get('/compensation/historique', [CompensationController::class, 'historique'])->name('compensation.historique');
    Route::get('/compensation/etat_journalier', [CompensationController::class, 'etatJournalier'])->name('compensation.etat_journalier');
    Route::get('/compensation/extrait', [CompensationController::class, 'extrait'])->name('compensation.extrait');
    Route::get('/compensation/get_client', [CompensationController::class, 'getClient'])->name('compensation.get_client');
    Route::get('/compensation/wsdata/{type}', [CompensationController::class, 'fetchWsData']);


    Route::post('/compensation/get_client/check/{accountNumber}', [CompensationController::class, 'checkClient'])->name('compensation.check_client');
    Route::post('/compensation/get_client/add_request', [CompensationController::class, 'addRequest'])->name('compensation.add_request');
    Route::post('/compensation/store/ws', [CompensationController::class, 'store_compensation'])->name('compensation.store_compensation');

    Route::get('/compensation/display/{id}', [CompensationController::class, 'display'])->name('compensation.display');

    Route::get('/compensation/edit/{id}', function ($id) {
        return "Testing edit route OK! ID: {$id}";
    })->name('compensationedit');
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
