<?php

use App\Http\Controllers\CompensationController;
use App\Http\Controllers\ProfileController;
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
    // Route::get('/compensation/etat_journalier/data', [CompensationController::class, 'etatJournalierData'])->name('compensation.etat_journalierData');
    Route::get('/compensation/extrait', [CompensationController::class, 'extrait'])->name('compensation.extrait');
    // Route::get('/compensation/extrait/data', [CompensationController::class, 'extraitData'])->name('compensation.extraitData');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
