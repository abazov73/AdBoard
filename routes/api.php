<?php

use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::apiResource('ads', AdController::class)->middleware('auth:sanctum');
Route::get('my', [AdController::class, 'indexMy'])->middleware('auth:sanctum');
