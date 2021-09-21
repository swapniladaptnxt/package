<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::post('/login',[App\Http\Controllers\Api\CustomerController::class, 'Login']);
Route::post('/register', [App\Http\Controllers\Api\CustomerController::class, 'Register']);

// sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// order
Route::get('/order/info', [App\Http\Controllers\Api\OrderController::class, 'index'])->middleware('auth:sanctum');
