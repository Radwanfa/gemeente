<?php

use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/melden', function () {
    return view('melden');
});

Route::get('/inloggen', function () {
    return view('inloggen');
});

Route::resource('complaint', ComplaintController::class)->except(['create', 'edit',])->middleware('auth');
Route::resource('complaint', ComplaintController::class)->only(['store']);