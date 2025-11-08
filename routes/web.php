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

// Dashboard — hanya bisa diakses setelah login & verifikasi email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Grup Route untuk Pengguna yang Sudah Login (User & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // === PROFILE (BISA DIAKSES SEMUA USER) ===
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === ROUTE AJAX ===
    // Dipakai oleh halaman tambah mahasiswa, jadi HARUS bisa diakses user & admin
    Route::get('/get-prodi/{fakultas_id}', [AjaxController::class, 'getProdi'])
        ->name('ajax.getProdi');

    // === USER BIASA ===
    // Hanya bisa melihat daftar mahasiswa dan prodi (tanpa CRUD)
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
        ->name('mahasiswa.index');
    Route::get('/prodi', [ProdiController::class, 'index'])
        ->name('prodi.index');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    | Semua route di bawah ini hanya bisa diakses oleh role = 'admin'
    */
    Route::middleware(['is_admin'])->group(function () {
        // CRUD lengkap untuk Fakultas, Prodi, dan Mahasiswa
        Route::resource('fakultas', FakultasController::class);
        Route::resource('prodi', ProdiController::class)->except(['index']);
        Route::resource('mahasiswa', MahasiswaController::class)->except(['index']);
    });
});

require __DIR__.'/auth.php';
