<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Routes to redirect to the / accesoires page and to a specific product page.
Route::get('/accessoires', function () { return view('acc_view');});
Route::get('/product', function () { return view('product_specifiek/acc_pagina');});
Route::get('/index', [App\http\Controllers\SortController::class, 'index']);
