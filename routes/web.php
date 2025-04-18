<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FournissourController;
use App\Http\Controllers\FactureAuthController;
use App\Http\Controllers\AutoEnregistrementController;
// use App\Http\Controllers\FactureAutoController;
use App\Http\Controllers\MarcheController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\FactureAutoController;
Route::get('/', function(){
    return view('home');
});
Route::resource('/factures',FactureController::class);
Route::resource('/fournisseur',FournissourController::class);
Route::get('/quiter',function(){
    return view('quiter');
});
Route::resource('/factureAuto', FactureAuthController::class);

Route::get('/factureauto/info/{id}', [FactureAutoController::class, 'getFactureInfo']);
Route::resource('/autorisation', AutoEnregistrementController::class);
// Route::get('/factureauto/info/{id}', [FactureAuthController::class, 'show'])->name('factureAuto.info');
Route::resource('/marche', MarcheController::class);
Route::resource('/consultation', ConsultController::class);
