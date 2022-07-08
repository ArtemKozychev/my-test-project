<?php

use App\Http\Controllers\Client\Callboard\CallboardCreateController;
use App\Http\Controllers\Client\Callboard\CallboardDeleteController;
use App\Http\Controllers\Client\Callboard\CallboardUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('callboard')
    ->name('callboard.')
    ->group(function (): void {

        Route::middleware(['auth', 'role:administrator'])
            ->group(function (): void {
                Route::post('/add', CallboardCreateController::class)->name('create');
                Route::patch('/{callboard}', CallboardUpdateController::class)->name('update');
                Route::delete('/{callboard}', CallboardDeleteController::class)->name('delete');
            });
    });
