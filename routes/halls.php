<?php

use App\Http\Controllers\Client\Hall\HallCreateController;
use App\Http\Controllers\Client\Hall\HallDeleteController;
use App\Http\Controllers\Client\Hall\HallUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('hall')
    ->name('hall.')
    ->group(function (): void {

        Route::middleware(['auth', 'role:administrator'])
            ->group(function (): void {
                Route::post('/add', HallCreateController::class)->name('create');
                Route::patch('/{hall}', HallUpdateController::class)->name('update');
                Route::delete('/{hall}', HallDeleteController::class)->name('delete');
            });
    });
