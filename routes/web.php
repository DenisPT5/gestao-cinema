<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\BilheteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('filmes', FilmeController::class);
    Route::resource('bilhetes', BilheteController::class)->only(['index','create','store','destroy']);
    Route::get('/sessoes', [SessaoController::class, 'index'])->name('sessoes.index');
    Route::get('/sessoes/create', [SessaoController::class, 'create'])->name('sessoes.create');
    Route::post('/sessoes', [SessaoController::class, 'store'])->name('sessoes.store');
    Route::get('/sessoes/{id}', [SessaoController::class, 'show'])->name('sessoes.show');
    Route::get('/sessoes/{id}/edit', [SessaoController::class, 'edit'])->name('sessoes.edit');
    Route::put('/sessoes/{id}', [SessaoController::class, 'update'])->name('sessoes.update');
    Route::delete('/sessoes/{id}', [SessaoController::class, 'destroy'])->name('sessoes.destroy');
});

require __DIR__.'/auth.php';