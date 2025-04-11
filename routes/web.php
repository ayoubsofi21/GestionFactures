<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FournissourController;



Route::get('/', function(){
    return view('home');
});
Route::resource('/factures',FactureController::class);
Route::resource('/fournisseur',FournissourController::class);