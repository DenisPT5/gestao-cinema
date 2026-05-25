<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\BilheteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard — todos acedem
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Filmes — superadmin e gestor
    Route::resource('filmes', FilmeController::class)->middleware('role:gestor');

    // Sessões — superadmin e gestor
    Route::get('/sessoes', [SessaoController::class, 'index'])->name('sessoes.index');
    Route::get('/sessoes/create', [SessaoController::class, 'create'])->name('sessoes.create')->middleware('role:gestor');
    Route::post('/sessoes', [SessaoController::class, 'store'])->name('sessoes.store')->middleware('role:gestor');
    Route::get('/sessoes/{id}', [SessaoController::class, 'show'])->name('sessoes.show');
    Route::get('/sessoes/{id}/edit', [SessaoController::class, 'edit'])->name('sessoes.edit')->middleware('role:gestor');
    Route::put('/sessoes/{id}', [SessaoController::class, 'update'])->name('sessoes.update')->middleware('role:gestor');
    Route::delete('/sessoes/{id}', [SessaoController::class, 'destroy'])->name('sessoes.destroy')->middleware('role:gestor');

    // Bilhetes — superadmin e gestor
    Route::resource('bilhetes', BilheteController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->middleware('role:gestor');

    // Gestão de utilizadores — apenas superadmin
    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware('role:superadmin');
});

require __DIR__.'/auth.php';