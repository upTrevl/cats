<?php

use App\Http\Controllers\BreedController;
use App\Http\Controllers\CatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatController::class, 'index'])->name('cats');

Route::controller(CatController::class)->prefix('cats')->name('cats.')->group(function () {
    Route::get('/get', 'get')->name('get');
    Route::post('/store', 'store')->name('store');
    Route::put('/update', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
    Route::get('/get-random-image','getRandomImage')->name('get-random-image');
});

Route::controller(BreedController::class)->prefix('breeds')->name('breeds.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/get', 'get')->name('get');
    Route::get('/search', 'search')->name('search');
    Route::post('/store', 'store')->name('store');
    Route::put('/update', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
});
