<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login'); // ✅ Redirige vers la page de login
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ces deux lignes sont optionnelles si tu utilises Laravel Breeze ou Jetstream
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('/pharmacien/dashboard', function () {
        return view('pharmacien.dashboard');
    })->name('pharmacien.dashboard');
});
Route::get('/chef/dashboard', function () {
    return view('chef.dashboard');
})->name('chef.dashboard');

use App\Http\Controllers\UserController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeFournisseurController;
use App\Http\Controllers\DetailCommandeController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\DetailEntreeController;
use App\Http\Controllers\CommandeServiceController;
use App\Http\Controllers\RetourProduitController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\AlerteStockController;
use App\Models\Depot;

Route::resource('users', UserController::class);
Route::resource('depots', DepotController::class);
Route::resource('fournisseurs', FournisseurController::class);
Route::resource('produits', ProduitController::class);
// Route::resource('commandes-fournisseur', CommandeFournisseurController::class);
Route::get('/commande-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commande-fournisseur.create');

Route::resource('details-commandes', DetailCommandeController::class);
Route::resource('entrees', EntreeController::class);
Route::resource('details-entrees', DetailEntreeController::class);
Route::resource('commandes-services', CommandeServiceController::class);
Route::resource('retours-produits', RetourProduitController::class);
Route::resource('ordonnances', OrdonnanceController::class);
Route::resource('alertes-stock', AlerteStockController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/pharmacie/dashboard', [Depot::class, 'dashboard'])->name('pharmacie.dashboard');
});

Route::get('/redirect-after-login', function () {
    if (auth()->user()->role === 'pharmacien') {
        return redirect('/pharmacien/dashboard');
    }
    // Ajouter d'autres rôles ici si besoin
    return redirect('/'); // page par défaut
});

use App\Http\Controllers\PharmacienController;

Route::middleware(['auth'])->group(function () {
    Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard');
});
// Route::resource('fournisseurs', FournisseurController::class);
// Route::resource('produits', ProduitController::class);
// Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
// Route::get('/stock', [StockController::class, 'index'])->name('stock.index');


