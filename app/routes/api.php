<?php

use App\Http\Controllers\Api\NewsController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::fallback(fn() => response()->json(['error' => 'Invalid route.'], Response::HTTP_NOT_FOUND));

Route::prefix('news')
    ->name('news.')
    ->controller(NewsController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');

        Route::middleware('news')
            ->group(function () {
                Route::get('{entity}', 'show')->name('show');
                Route::patch('{entity}/status', 'changeStatus')->name('change_status');
            });
    });