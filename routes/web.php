<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\InvitationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/urls',[UrlController::class,'index']);
    Route::post('/urls',[UrlController::class,'store']);
    // Route::post('/invite',[InvitationController::class,'invite']);

    Route::get('/invite', [InvitationController::class, 'create']);
    Route::post('/invite', [InvitationController::class, 'store']);
});

// public redirect
Route::get('/r/{code}', [UrlController::class,'redirect']);

require __DIR__.'/auth.php';

