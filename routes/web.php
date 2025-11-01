<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Hanya user yang sudah login dan emailnya terverifikasi bisa akses dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua route di bawah hanya untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {

    // Profil user biasa
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Rute khusus Admin
    |--------------------------------------------------------------------------
    | Semua route di dalam grup ini hanya bisa diakses oleh user dengan role=admin
    */
    Route::middleware(['is_admin'])->group(function () {

        // CRUD Fakultas, Prodi, dan Mahasiswa
        Route::resource('fakultas', FakultasController::class);
        Route::resource('prodi', ProdiController::class);
        Route::resource('mahasiswa', MahasiswaController::class);

        // AJAX untuk dropdown dinamis
        Route::get('/get-prodi/{fakultas_id}', [AjaxController::class, 'getProdi'])
             ->name('ajax.getProdi');
    });
});

require __DIR__.'/auth.php';
