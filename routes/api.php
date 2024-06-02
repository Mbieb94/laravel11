<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->withoutMiddleware(['token.validation'])->name('auth.login');
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        $response = new ApiResponse();
        try {
            return $response->data($request->user())->send();
        } catch (Exception $e) {
            return $response->message($e->getMessage())->send();
        }
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');;
});
