<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Middleware\CheckUserType;
    use App\Http\Controllers\FactureController;
    use App\Http\Controllers\AutoEnregistrementController;
    use  App\Http\Controllers\ConsultController;
    use App\Http\Controllers\FournissourController;
    use App\Http\Controllers\MarcheController;
    use App\Http\Controllers\FactureAuthController;
    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\users\DashboardController;


    Route::get('/', function () {
        return view('good');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    // Routes accessible to all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::get('/consultation', [ConsultController::class, 'index'])->name('consultation');

    Route::get('/factures/hors-delai', [FactureController::class, 'facturesHorsDelai'])->name('factures.hors-delai');
    Route::get('/factureAuto', [FactureAuthController::class, 'index'])->name('factureAuto.index');
});

// Director-only routes (combines all permissions)
// Route::middleware(['auth', CheckUserType::class . ':Directeur'])->group(function () {
//     Route::resource('autorisation', AutoEnregistrementController::class);
//     Route::get('/consultation', [ConsultController::class, 'index'])->name('consultation');
//     Route::get('register-admin', [RegisteredUserController::class, 'showForm'])->name('register-admin');
//     Route::post('register-admin', [RegisteredUserController::class, 'store'])->name('register-admin.store');
//     Route::get('/factures/hors-delai', [FactureController::class, 'facturesHorsDelai'])->name('factures.hors-delai');
//     Route::get('/factureAuto', [FactureAuthController::class, 'index'])->name('factureAuto.index');
//     //add routes
//     Route::resource('factures', FactureController::class);
//     Route::resource('fournisseur', FournissourController::class);
//     Route::resource('marche', MarcheController::class);
//     Route::resource('factureAuto', FactureAuthController::class)->except(['index']);


// });
Route::middleware(['auth', CheckUserType::class . ':Directeur'])->group(function () {
    Route::resource('autorisation', AutoEnregistrementController::class);
    Route::resource('fournisseur', FournissourController::class);
    Route::resource('marche', MarcheController::class);
    Route::resource('factures', FactureController::class);
    Route::get('register-admin', [RegisteredUserController::class, 'showForm'])->name('register-admin');
    Route::post('register-admin', [RegisteredUserController::class, 'store'])->name('register-admin.store');
    Route::get('/check-autorisation', [FactureController::class, 'checkAutorisation'])->name('check-autorisation');
    Route::resource('factureAuto', FactureAuthController::class)->except(['index']);
});
 
// // Admin-only routes
// Route::middleware(['auth', CheckUserType::class . ':Administrateur'])->group(function () {
//     Route::resource('factures', FactureController::class);
//     Route::resource('autorisation', AutoEnregistrementController::class);
//     Route::get('/factures/valider/{id}', [FactureController::class, 'validerFacture'])->name('factures.valider');
//     Route::get('/check-autorisation', [FactureController::class, 'checkAutorisation'])->name('check-autorisation');
// });

// // Employee routes
// Route::middleware(['auth', CheckUserType::class . ':Employe'])->group(function () {
//     Route::resource('fournisseur', FournissourController::class);
//     Route::resource('marche', MarcheController::class);
// });

// // Financial routes
// Route::middleware(['auth', CheckUserType::class . ':Financier'])->group(function () {
//     Route::resource('factureAuto', FactureAuthController::class)->except(['index']);
//     Route::get('/factureAuto', [FactureAuthController::class, 'index'])->name('factureAuto.index');
// });

require __DIR__.'/auth.php';