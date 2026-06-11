<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KutipanController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\SesiFokusController;
use App\Http\Controllers\TugasController;

Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:auth');

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:auth')->name('login');
Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated'], 401);
})->name('login');

Route::get('/auth/google/redirect', [AuthController::class, 'googleRedirect'])->middleware('throttle:auth');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->middleware('throttle:auth');

Route::get('/kutipan', [KutipanController::class, 'index']);
Route::get('/kutipan/{kutipan}', [KutipanController::class, 'show']);

Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('tugas', TugasController::class);
    Route::apiResource('sesi-fokus', SesiFokusController::class);
    Route::apiResource('progres', ProgresController::class);
    Route::apiResource('kutipan', KutipanController::class)->except(['index', 'show']);
});