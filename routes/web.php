<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrosController;

Route::get('/', LivrosController::class .'@index')->name('livros.indexAll');
Route::get('/id/{post}', LivrosController::class .'@indexID')->name('livros.index');
Route::get('/filter', LivrosController::class .'@showFilter')->name('livros.filter');