<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\FakultasController;

// Endpoint umum (tanpa login)
Route::get('/ping', function () {
    return response()->json(['message' => 'Server aktif.']);
});

// Login dan logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// API yang butuh autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // CRUD untuk Mahasiswa, Prodi, Fakultas
    Route::apiResource('mahasiswa', MahasiswaController::class);
    Route::apiResource('prodi', ProdiController::class);
    Route::apiResource('fakultas', FakultasController::class);
});
