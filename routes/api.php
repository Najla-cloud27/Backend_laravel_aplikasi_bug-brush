<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KutipanController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\SesiFokusController;
use App\Http\Controllers\TugasController;

// router untuk register api/postman
Route::post('/register', [AuthController::class, 'register']);
// begitupun dengan login api/postman
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// ROUTE CRUD KATEGORI
Route::apiResource('kategori', KategoriController::class);

// ROUTE CRUD TUGAS
Route::apiResource('tugas', TugasController::class);

// Rooute CRUD SESI FOKUS
Route::apiResource('sesi-fokus', SesiFokusController::class);

// ROUTE CRUD PROGRESS
Route::apiResource('progres', ProgresController::class);

// ROUTE CRUD KUTIPAN
Route::apiResource('kutipan', KutipanController::class);