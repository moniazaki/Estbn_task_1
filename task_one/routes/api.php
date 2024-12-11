<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum',
])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


    Route::apiResource('activity-logs', ActivityLogController::class);

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
