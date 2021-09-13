<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TokenController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('tokens', [TokenController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', function (Request $r) { return new UserResource($r->user()); });
    Route::delete('tokens', [TokenController::class, 'destroy']);
    Route::apiResource('posts', PostController::class);
});
