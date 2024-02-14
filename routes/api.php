<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrosController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/livros/create', LivrosController::class .'@store')->name('livros.store');
Route::put('/livros/{post}', LivrosController::class .'@update')->name('livros.update');
Route::delete('/livros/{post}', LivrosController::class .'@destroy')->name('livros.destroy');
