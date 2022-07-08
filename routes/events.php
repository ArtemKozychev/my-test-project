<?php

use App\Http\Controllers\Client\Event\EventCreateController;
use App\Http\Controllers\Client\Event\EventDeleteController;
use App\Http\Controllers\Client\Event\EventUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('event')
    ->name('event.')
    ->group(function (): void {

        Route::middleware(['auth', 'role:administrator'])
            ->group(function (): void {
                Route::post('/add', EventCreateController::class)->name('create');
                Route::patch('/{event}', EventUpdateController::class)->name('update');
                Route::delete('/{event}', EventDeleteController::class)->name('delete');
            });
    });
