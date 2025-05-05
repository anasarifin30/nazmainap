<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('users.landingpage');
});
Route::get('/kataloghomestay', function () {
    return view('users.kataloghomestay');
});
Route::get('/detailhomestay', function () {
    return view('users.detailhomestay');
});

Route::get('/allphotohomestay', function () {
    return view('users.allphotohomestay');
});

Route::get('/registerguest', function () {
    return view('auth.registerguest');
});

Route::get('/registerowner', function () {
    return view('auth.registerowner');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
