<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil avec statistiques
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes pour les filières
Route::resource('filieres', FiliereController::class)
    ->except(['show', 'edit', 'update']);

// Routes pour les étudiants
Route::resource('etudiants', EtudiantController::class)
    ->except(['show', 'edit', 'update']);