<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// routes/api.php
Route::post('/factures', [FactureController::class, 'store']);

