<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AjaxController;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('fakultas', FakultasController::class);
Route::resource('prodi', ProdiController::class);

Route::get('/get-prodi/{fakultas_id}', [AjaxController::class, 'getProdi']);