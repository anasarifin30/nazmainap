<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\HomestayController;

//ADMIN IKII
Route::get('/admin', function () {
    return view('admin.dashboard');
});

//TABEL USER
Route::get('/admin/user', [UserController::class, 'index'])->name('users.index');
Route::delete('/admin/user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('users.create');
Route::post('/admin/user', [UserController::class, 'store'])->name('users.store');
Route::get('/admin/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/admin/user/{user}', [UserController::class, 'update'])->name('users.update');

//TABEL HOMESTAY
Route::get('/admin/homestay', [HomestayController::class, 'index'])->name('homestays.index');
Route::delete('/admin/homestay/{homestay}', [HomestayController::class, 'destroy'])->name('homestays.destroy');
Route::get('/admin/homestay/create', [HomestayController::class, 'create'])->name('homestays.create');
Route::post('/admin/homestay', [HomestayController::class, 'store'])->name('homestays.store');
Route::get('/admin/homestay/{homestay}/edit', [HomestayController::class, 'edit'])->name('homestays.edit');
Route::put('/admin/homestay/{homestay}', [HomestayController::class, 'update'])->name('homestays.update');


//USER IKII
Route::get('/', function () {
    return view('users.landingpage');
});
Route::get('/kataloghomestay', function () {
    return view('users.kataloghomestay');
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
