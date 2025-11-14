<?php

use App\Exports\CollaboratorExport;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\EconomicGroupController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitController;
use App\Models\Collaborator;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::prefix('economicGroup')->group(function () {
        Route::get('/show', [EconomicGroupController::class, 'show'])->name('economicGroup.show');
        Route::get('/create', [EconomicGroupController::class, 'create'])->name('economicGroup.create');
        Route::get('/edit/{id}', [EconomicGroupController::class, 'edit'])->name('economicGroup.edit');
        Route::get('/destroy/{id}', [EconomicGroupController::class, 'destroy'])->name('economicGroup.destroy');
    });

    Route::prefix('flag')->group(function () {
        Route::get('/show', [FlagController::class, 'show'])->name('flag.show');
        Route::get('/create', [FlagController::class, 'create'])->name('flag.create');
        Route::get('/edit/{id}', [FlagController::class, 'edit'])->name('flag.edit');
        Route::get('/destroy/{id}', [FlagController::class, 'destroy'])->name('flag.destroy');
    });

    Route::prefix('unit')->group(function () {
        Route::get('/show', [UnitController::class, 'show'])->name('unit.show');
        Route::get('/create', [UnitController::class, 'create'])->name('unit.create');
        Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
        Route::get('/destroy/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
        Route::get('/collaboratorForUnit', [UnitController::class, 'collaboratorForUnit']);
    });

    Route::prefix('collaborator')->group(function () {
        Route::get('/show', [CollaboratorController::class, 'show'])->name('collaborator.show');
        Route::get('/create', [CollaboratorController::class, 'create'])->name('collaborator.create');
        Route::get('/edit/{id}', [CollaboratorController::class, 'edit'])->name('collaborator.edit');
        Route::get('/destroy/{id}', [CollaboratorController::class, 'destroy'])->name('collaborator.destroy');
        Route::get('download-relatorio', function () {
            return Excel::download(new CollaboratorExport, 'relatorio-Collaboradores.xlsx');
        })->name('download');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/audits', [\App\Http\Controllers\AuditController::class, 'index'])->name('audits');
});


require __DIR__ . '/auth.php';
