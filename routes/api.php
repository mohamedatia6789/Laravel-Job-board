<?php

use App\Http\Controllers\api\ApiPostController;

Route::prefix("v1")->group(function () {

    Route::apiResource("post", ApiPostController::class);
});
Route::prefix("v2")->group(function () {

    Route::apiResource("post", ApiPostController::class);
});
Route::post('/login', [App\Http\Controllers\api\ApiAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [App\Http\Controllers\api\ApiAuthController::class, 'profile']);
    Route::post('/logout', [App\Http\Controllers\api\ApiAuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\api\ApiAuthController::class, 'refresh']);
});


