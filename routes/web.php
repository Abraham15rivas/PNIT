<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredController;

Route::get('/', function () { 
    return view('auth.login');
});

Auth::routes();

Route::prefix('api')->group(function () {
    Route::get('/registrados', [RegisteredController::class, 'index']);
    Route::get('/investigador/{id}', [RegisteredController::class, 'show']);

});



Route::get('registrados', function () {
    return view('layouts.app');
});