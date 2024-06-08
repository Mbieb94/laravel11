<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)
        ->name('profile.')
        ->prefix('profile')
        ->group(function () {
            Route::get('', 'edit')->name('edit');
            Route::patch('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });
    
    Route::controller(AppController::class)
        ->prefix('{collection}')
        ->name(request()->segment(1) . '.')
        ->group(function () {
            Route::get('/', 'list')->name('list');
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