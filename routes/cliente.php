<?php
use App\Http\Controllers\Cliente\ClienteAuthController;
use App\Http\Controllers\Cliente\ClienteDashboardController;
use App\Http\Controllers\Cliente\ClienteBilheteController;
use App\Http\Controllers\Cliente\ClientePerfilController;
use Illuminate\Support\Facades\Route;

// ── Rotas públicas da área do cliente ──────────────────────────────────────
Route::prefix('cliente')->name('cliente.')->group(function () {

    // Auth
    Route::get('/login',    [ClienteAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [ClienteAuthController::class, 'login']);
    Route::get('/register', [ClienteAuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[ClienteAuthController::class, 'register']);
    Route::get('/logout',   [ClienteAuthController::class, 'logout'])->name('logout');

    // Rotas protegidas pelo middleware cliente.auth
    Route::middleware('cliente.auth')->group(function () {
        Route::get('/dashboard',         [ClienteDashboardController::class, 'index'])->name('dashboard');
        Route::get('/sessoes',           [ClienteBilheteController::class, 'sessoes'])->name('sessoes');
        Route::post('/bilhetes/comprar', [ClienteBilheteController::class, 'comprar'])->name('bilhetes.comprar');
        Route::get('/bilhetes',          [ClienteBilheteController::class, 'index'])->name('bilhetes');
        Route::delete('/bilhetes/{bilhete}/cancelar', [ClienteBilheteController::class, 'cancelar'])->name('bilhetes.cancelar');
        Route::get('/perfil',            [ClientePerfilController::class, 'index'])->name('perfil');
        Route::post('/perfil',           [ClientePerfilController::class, 'update'])->name('perfil.update');
        Route::post('/perfil/password',  [ClientePerfilController::class, 'updatePassword'])->name('perfil.password');
    });
});
