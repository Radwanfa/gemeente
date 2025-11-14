<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/melden', function () {
    return view('melden');
});

Route::get('/inloggen', [AdminController::class, 'showLogin']);

Route::post('/inloggen', [AdminController::class, 'login']);
Route::post('/uitloggen', [AdminController::class, 'logout']);

Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/dashboard/complaint/{id}', [AdminController::class, 'showComplaint'])->name('complaint.show');


Route::get('/storage/images/{filename}', function ($filename) {
    $path = storage_path('app/public/images/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    $file = file_get_contents($path);
    $type = mime_content_type($path);
    
    return response($file, 200)->header('Content-Type', $type);
})->where('filename', '[A-Za-z0-9._-]+');


Route::resource('complaint', ComplaintController::class)->except(['create', 'edit',])->middleware('auth');
Route::resource('complaint', ComplaintController::class)->only(['store']);