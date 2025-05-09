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
