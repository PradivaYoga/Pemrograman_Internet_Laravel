<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('fakultas', FakultasController::class);
Route::resource('prodi', ProdiController::class);