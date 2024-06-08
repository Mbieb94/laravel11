<?php

use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComponentsController;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->withoutMiddleware(['token.validation'])->name('auth.login');
});


Route::middleware(['auth:sanctum'])->group(function () {
    // Route::get('/user', function (Request $request) {
    //     $response = new ApiResponse();
    //     try {
    //         return $response->data($request->user())->send();
    //     } catch (Exception $e) {
    //         return $response->message($e->getMessage())->send();
    //     }
    // });

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::controller(ComponentsController::class)
        ->prefix('components')
        ->group(function () {
            Route::get('select2reference/{model}/{key}/{display}', 'select2refence');
            Route::get('sysparam-reference/{group}', 'sysparamReference');
        });

    Route::controller(AppController::class)
        ->prefix('{collection}')
        ->name(request()->segment(1) . '.')
        ->group(function () {
            Route::get('/', 'fetchDataTable')->name('list');
            Route::post('/', 'store')->name('create');
            Route::get('/export', 'export')->name('export');
            Route::get('/create', 'create')->name('create');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/{id}', 'detail')->name('detail');
            Route::put('/{id}', 'update')->name('edit');
            Route::post('/{id}', 'delete')->name('delete');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/trash', 'trash')->name('trash');
            Route::put('/{id}/restore', 'restore')->name('restore');
        });
});
